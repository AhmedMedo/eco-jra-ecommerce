<?php

namespace Plugin\Multivendor\Repositories;

use Illuminate\Support\Collection;
use Plugin\Multivendor\Models\IrecRedemption;
use Plugin\Multivendor\Models\IrecProjectTransaction;
use Illuminate\Support\Facades\DB;

class IrecRedemptionRepository
{
    /**
     * Create a new redemption request
     */
    public function createRedemption(array $redemptionData): IrecRedemption
    {
        return IrecRedemption::create($redemptionData);
    }

    /**
     * Get redemptions for a specific transaction
     */
    public function getTransactionRedemptions(int $transactionId): Collection
    {
        return IrecRedemption::with(['buyer', 'reviewer'])
            ->where('transaction_id', $transactionId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get redemptions for a specific buyer
     */
    public function getBuyerRedemptions(int $buyerId): Collection
    {
        return IrecRedemption::with(['transaction.project', 'reviewer'])
            ->where('buyer_id', $buyerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get a specific redemption by ID
     */
    public function getRedemption(int $redemptionId): ?IrecRedemption
    {
        return IrecRedemption::with(['transaction.project', 'buyer', 'reviewer'])
            ->find($redemptionId);
    }

    /**
     * Update redemption status
     */
    public function updateRedemptionStatus(int $redemptionId, string $status, ?int $reviewedBy = null, ?string $reviewNotes = null): bool
    {
        $redemption = IrecRedemption::find($redemptionId);
        
        if (!$redemption) {
            return false;
        }

        $updateData = [
            'redemption_status' => $status,
            'reviewed_at' => now(),
        ];

        if ($reviewedBy) {
            $updateData['reviewed_by'] = $reviewedBy;
        }

        if ($reviewNotes) {
            $updateData['review_notes'] = $reviewNotes;
        }

        return $redemption->update($updateData);
    }

    /**
     * Get redemptions by status
     */
    public function getRedemptionsByStatus(string $status): Collection
    {
        return IrecRedemption::with(['transaction.project', 'buyer'])
            ->where('redemption_status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get pending redemptions for admin review
     */
    public function getPendingRedemptions(): Collection
    {
        return $this->getRedemptionsByStatus('pending');
    }

    /**
     * Calculate remaining quantity for a transaction
     */
    public function getRemainingQuantity(int $transactionId): float
    {
        $transaction = IrecProjectTransaction::find($transactionId);
        
        if (!$transaction) {
            return 0;
        }

        // Get total redeemed quantity (only approved redemptions)
        $totalRedeemed = IrecRedemption::where('transaction_id', $transactionId)
            ->where('redemption_status', 'approved')
            ->sum('quantity_mwh');

        // Calculate remaining quantity
        $remaining = $transaction->quantity_mwh - $totalRedeemed;
        
        return max(0, $remaining); // Ensure it doesn't go below 0
    }

    /**
     * Check if redemption is possible for a transaction
     */
    public function canRedeem(int $transactionId, float $quantityToRedeem): array
    {
        $transaction = IrecProjectTransaction::find($transactionId);
        
        if (!$transaction) {
            return [
                'can_redeem' => false,
                'message' => 'Transaction not found'
            ];
        }

        // Check if transaction is completed
        if ($transaction->transaction_status !== 'completed') {
            return [
                'can_redeem' => false,
                'message' => 'Transaction must be completed before redemption'
            ];
        }

        // Get remaining quantity
        $remainingQuantity = $this->getRemainingQuantity($transactionId);

        // Check if there's enough remaining quantity
        if ($quantityToRedeem > $remainingQuantity) {
            return [
                'can_redeem' => false,
                'message' => "Insufficient remaining quantity. Available: {$remainingQuantity} MWh"
            ];
        }

        // Check minimum redemption amount (e.g., at least 0.01 MWh)
        if ($quantityToRedeem < 0.01) {
            return [
                'can_redeem' => false,
                'message' => 'Minimum redemption amount is 0.01 MWh'
            ];
        }

        return [
            'can_redeem' => true,
            'remaining_quantity' => $remainingQuantity,
            'message' => 'Redemption is possible'
        ];
    }

    /**
     * Process redemption request
     */
    public function processRedemption(int $transactionId, int $buyerId, float $quantityMwh, ?string $purpose = null, ?string $notes = null): array
    {
        try {
            DB::beginTransaction();

            // Check if redemption is possible
            $canRedeem = $this->canRedeem($transactionId, $quantityMwh);
            
            if (!$canRedeem['can_redeem']) {
                return [
                    'success' => false,
                    'message' => $canRedeem['message']
                ];
            }

            // Calculate remaining quantity after this redemption
            $remainingAfterRedemption = $canRedeem['remaining_quantity'] - $quantityMwh;

            // Create redemption record
            $redemption = $this->createRedemption([
                'transaction_id' => $transactionId,
                'buyer_id' => $buyerId,
                'quantity_mwh' => $quantityMwh,
                'remaining_quantity_mwh' => $remainingAfterRedemption,
                'redemption_purpose' => $purpose,
                'notes' => $notes,
                'redemption_status' => 'approved', // Auto-approve redemptions
            ]);

            // Update transaction's remaining quantity and redeemed quantity
            $transaction = IrecProjectTransaction::find($transactionId);
            $transaction->remaining_quantity_mwh = $remainingAfterRedemption;
            $transaction->redeemed_quantity_mwh += $quantityMwh; // Add to redeemed quantity
            $transaction->save();

            DB::commit();

            return [
                'success' => true,
                'redemption' => $redemption,
                'message' => 'Redemption request submitted successfully'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Failed to process redemption: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get redemption statistics
     */
    public function getRedemptionStats(): array
    {
        $totalRedemptions = IrecRedemption::count();
        $pendingRedemptions = IrecRedemption::where('redemption_status', 'pending')->count();
        $approvedRedemptions = IrecRedemption::where('redemption_status', 'approved')->count();
        $rejectedRedemptions = IrecRedemption::where('redemption_status', 'rejected')->count();

        return [
            'total_redemptions' => $totalRedemptions,
            'pending_redemptions' => $pendingRedemptions,
            'approved_redemptions' => $approvedRedemptions,
            'rejected_redemptions' => $rejectedRedemptions,
        ];
    }
}
