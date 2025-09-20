<?php

namespace Plugin\Multivendor\Repositories;

use Illuminate\Support\Collection;
use Plugin\Multivendor\Models\IrecPayment;
use Plugin\Multivendor\Models\IrecProjectTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IrecPaymentRepository
{
    /**
     * Create a new payment record
     */
    public function createPayment(array $paymentData): IrecPayment
    {
        return IrecPayment::create($paymentData);
    }

    /**
     * Get payments for a specific buyer
     */
    public function getBuyerPayments(int $buyerId): Collection
    {
        return IrecPayment::with(['transaction.project', 'reviewer'])
            ->where('buyer_id', $buyerId)
            ->orderBy('submitted_at', 'desc')
            ->get();
    }

    /**
     * Get a specific payment by ID
     */
    public function getPayment(int $paymentId): ?IrecPayment
    {
        return IrecPayment::with(['transaction.project', 'buyer', 'reviewer'])
            ->find($paymentId);
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(int $paymentId, string $status, ?int $reviewedBy = null, ?string $notes = null): bool
    {
        $payment = IrecPayment::find($paymentId);
        
        if (!$payment) {
            return false;
        }

        $updateData = [
            'payment_status' => $status,
            'reviewed_at' => now(),
        ];

        if ($reviewedBy) {
            $updateData['reviewed_by'] = $reviewedBy;
        }

        if ($notes) {
            $updateData['notes'] = $notes;
        }

        return $payment->update($updateData);
    }

    /**
     * Get payments by status
     */
    public function getPaymentsByStatus(string $status): Collection
    {
        return IrecPayment::with(['transaction.project', 'buyer'])
            ->where('payment_status', $status)
            ->orderBy('submitted_at', 'desc')
            ->get();
    }

    /**
     * Get pending payments for admin review
     */
    public function getPendingPayments(): Collection
    {
        return $this->getPaymentsByStatus('pending');
    }

    /**
     * Process payment submission from cart checkout
     */
    public function processCartCheckout(int $buyerId, array $paymentData, array $cartItems): array
    {
        try {
            DB::beginTransaction();

            $transactions = [];
            $payments = [];

            // Create transactions for each cart item
            foreach ($cartItems as $cartItem) {
                $transaction = IrecProjectTransaction::create([
                    'project_id' => $cartItem['project_id'],
                    'buyer_id' => $buyerId,
                    'quantity_mwh' => $cartItem['quantity_mwh'],
                    'price_per_mwh' => $cartItem['price_per_mwh'],
                    'total_amount' => $cartItem['total_amount'],
                    'transaction_status' => 'pending',
                    'transaction_date' => now(),
                ]);

                $transactions[] = $transaction;

                // Create payment record for each transaction
                $payment = IrecPayment::create([
                    'buyer_id' => $buyerId,
                    'transaction_id' => $transaction->id,
                    'bank_name' => $paymentData['bank_name'],
                    'iban' => $paymentData['iban'],
                    'account_number' => $paymentData['account_number'],
                    'account_holder_name' => $paymentData['account_holder_name'],
                    'receipt_path' => $paymentData['receipt_path'] ?? null,
                    'payment_status' => 'pending',
                    'submitted_at' => now(),
                ]);

                $payments[] = $payment;
            }

            DB::commit();

            return [
                'success' => true,
                'transactions' => $transactions,
                'payments' => $payments,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Upload receipt file
     */
    public function uploadReceipt($file): string
    {
        $filename = 'receipt_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('payments/receipts', $filename, 'public');
        
        return $path;
    }

    /**
     * Delete receipt file
     */
    public function deleteReceipt(string $filePath): bool
    {
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }
        
        return false;
    }

    /**
     * Get payment statistics
     */
    public function getPaymentStats(): array
    {
        $totalPayments = IrecPayment::count();
        $pendingPayments = IrecPayment::where('payment_status', 'pending')->count();
        $approvedPayments = IrecPayment::where('payment_status', 'approved')->count();
        $rejectedPayments = IrecPayment::where('payment_status', 'rejected')->count();

        return [
            'total_payments' => $totalPayments,
            'pending_payments' => $pendingPayments,
            'approved_payments' => $approvedPayments,
            'rejected_payments' => $rejectedPayments,
        ];
    }
}

