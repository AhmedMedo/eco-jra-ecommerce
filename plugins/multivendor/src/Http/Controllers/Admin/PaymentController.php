<?php

namespace Plugin\Multivendor\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugin\Multivendor\Repositories\IrecPaymentRepository;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(IrecPaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Get all pending payments for admin review
     */
    public function getPendingPayments()
    {
        $payments = $this->paymentRepository->getPendingPayments();

        return response()->json([
            'success' => true,
            'payments' => $payments
        ]);
    }

    /**
     * Get payment details for review
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

        return response()->json([
            'success' => true,
            'payment' => $payment
        ]);
    }

    /**
     * Approve a payment
     */
    public function approvePayment(Request $request, $paymentId)
    {
        $validator = Validator::make($request->all(), [
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $result = $this->paymentRepository->updatePaymentStatus(
            $paymentId,
            'approved',
            auth()->id(),
            $request->notes
        );

        if ($result) {
            // Update the related transaction status to completed
            $payment = $this->paymentRepository->getPayment($paymentId);
            if ($payment && $payment->transaction) {
                $payment->transaction->update(['transaction_status' => 'completed']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment approved successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to approve payment'
        ], 500);
    }

    /**
     * Reject a payment
     */
    public function rejectPayment(Request $request, $paymentId)
    {
        $validator = Validator::make($request->all(), [
            'notes' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $result = $this->paymentRepository->updatePaymentStatus(
            $paymentId,
            'rejected',
            auth()->id(),
            $request->notes
        );

        if ($result) {
            // Update the related transaction status to cancelled
            $payment = $this->paymentRepository->getPayment($paymentId);
            if ($payment && $payment->transaction) {
                $payment->transaction->update(['transaction_status' => 'cancelled']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment rejected successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to reject payment'
        ], 500);
    }

    /**
     * Get payment statistics for admin dashboard
     */
    public function getPaymentStats()
    {
        $stats = $this->paymentRepository->getPaymentStats();

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }

    /**
     * Get all payments with filters
     */
    public function getAllPayments(Request $request)
    {
        $status = $request->get('status');
        $payments = $status ? 
            $this->paymentRepository->getPaymentsByStatus($status) : 
            $this->paymentRepository->getPendingPayments();

        return response()->json([
            'success' => true,
            'payments' => $payments
        ]);
    }
}