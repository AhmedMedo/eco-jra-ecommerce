<?php

namespace Plugin\Multivendor\Http\Controllers\Buyer\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugin\Multivendor\Repositories\IrecPaymentRepository;
use Plugin\Multivendor\Repositories\IrecCartRepository;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $paymentRepository;
    protected $cartRepository;

    public function __construct(
        IrecPaymentRepository $paymentRepository,
        IrecCartRepository $cartRepository
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Process checkout with payment information
     */
    public function processCheckout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string|max:255',
            'iban' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_holder_name' => 'required|string|max:255',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $buyerId = auth()->id();
            $cartItems = $this->cartRepository->getCartItems($buyerId);

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty'
                ], 400);
            }

            // Prepare payment data
            $paymentData = [
                'bank_name' => $request->bank_name,
                'iban' => $request->iban,
                'account_number' => $request->account_number,
                'account_holder_name' => $request->account_holder_name,
            ];

            // Handle receipt upload
            if ($request->hasFile('receipt')) {
                $paymentData['receipt_path'] = $this->paymentRepository->uploadReceipt($request->file('receipt'));
            }

            // Prepare cart items data
            $cartItemsData = $cartItems->map(function ($item) {
                return [
                    'project_id' => $item->project_id,
                    'quantity_mwh' => $item->quantity_mwh,
                    'price_per_mwh' => $item->price_per_mwh,
                    'total_amount' => $item->total_amount, // Use the already calculated total from cart item
                ];
            })->toArray();

            // Process the checkout
            $result = $this->paymentRepository->processCartCheckout($buyerId, $paymentData, $cartItemsData);

            if ($result['success']) {
                // Clear the cart after successful checkout
                $this->cartRepository->clearCart($buyerId);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment submitted successfully! Your transaction is pending review.',
                    'transactions' => $result['transactions'],
                    'payments' => $result['payments'],
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to process payment: ' . $result['error']
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your payment'
            ], 500);
        }
    }

    /**
     * Get buyer's payment history
     */
    public function getPaymentHistory(Request $request)
    {
        $buyerId = auth()->id();
        $payments = $this->paymentRepository->getBuyerPayments($buyerId);

        return response()->json([
            'success' => true,
            'payments' => $payments
        ]);
    }

    /**
     * Get a specific payment details
     */
    public function getPaymentDetails($paymentId)
    {
        $payment = $this->paymentRepository->getPayment($paymentId);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        // Check if the payment belongs to the authenticated user
        if ($payment->buyer_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'payment' => $payment
        ]);
    }
}

