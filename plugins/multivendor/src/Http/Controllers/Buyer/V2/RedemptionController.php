<?php

namespace Plugin\Multivendor\Http\Controllers\Buyer\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugin\Multivendor\Repositories\IrecRedemptionRepository;
use Plugin\Multivendor\Models\IrecProjectTransaction;
use Illuminate\Support\Facades\Validator;

class RedemptionController extends Controller
{
    protected $redemptionRepository;

    public function __construct(IrecRedemptionRepository $redemptionRepository)
    {
        $this->redemptionRepository = $redemptionRepository;
    }

    /**
     * Show redemption form for a transaction
     */
    public function showRedemptionForm($transactionId)
    {
        $transaction = IrecProjectTransaction::with(['project', 'redemptions'])
            ->where('buyer_id', auth()->id())
            ->find($transactionId);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        if (!$transaction->canBeRedeemed()) {
            return response()->json([
                'success' => false,
                'message' => 'This transaction cannot be redeemed'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'transaction' => [
                'id' => $transaction->id,
                'project_name' => $transaction->project->project_name,
                'project_id' => $transaction->project->project_id,
                'total_quantity' => $transaction->quantity_mwh,
                'remaining_quantity' => $transaction->remaining_quantity,
                'formatted_remaining_quantity' => $transaction->formatted_remaining_quantity,
                'total_redeemed' => $transaction->total_redeemed,
                'formatted_total_redeemed' => $transaction->formatted_total_redeemed,
            ],
            'redemptions' => $transaction->redemptions->map(function ($redemption) {
                return [
                    'id' => $redemption->id,
                    'redemption_reference' => $redemption->redemption_reference,
                    'quantity_mwh' => $redemption->quantity_mwh,
                    'formatted_quantity' => $redemption->formatted_quantity,
                    'redemption_status' => $redemption->redemption_status,
                    'redemption_purpose' => $redemption->redemption_purpose,
                    'notes' => $redemption->notes,
                    'created_at' => $redemption->created_at->format('M d, Y H:i'),
                    'reviewed_at' => $redemption->reviewed_at ? $redemption->reviewed_at->format('M d, Y H:i') : null,
                    'review_notes' => $redemption->review_notes,
                ];
            })
        ]);
    }

    /**
     * Process redemption request
     */
    public function processRedemption(Request $request, $transactionId)
    {
        $validator = Validator::make($request->all(), [
            'quantity_mwh' => 'required|numeric|min:0.01',
            'redemption_purpose' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
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
            $quantityMwh = $request->quantity_mwh;
            $purpose = $request->redemption_purpose;
            $notes = $request->notes;

            // Process the redemption
            $result = $this->redemptionRepository->processRedemption(
                $transactionId,
                $buyerId,
                $quantityMwh,
                $purpose,
                $notes
            );

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'redemption' => [
                        'id' => $result['redemption']->id,
                        'redemption_reference' => $result['redemption']->redemption_reference,
                        'quantity_mwh' => $result['redemption']->quantity_mwh,
                        'formatted_quantity' => $result['redemption']->formatted_quantity,
                        'remaining_quantity_mwh' => $result['redemption']->remaining_quantity_mwh,
                        'formatted_remaining_quantity' => $result['redemption']->formatted_remaining_quantity,
                        'redemption_status' => $result['redemption']->redemption_status,
                        'redemption_purpose' => $result['redemption']->redemption_purpose,
                        'notes' => $result['redemption']->notes,
                        'created_at' => $result['redemption']->created_at->format('M d, Y H:i'),
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your redemption request'
            ], 500);
        }
    }

    /**
     * Get redemptions for a specific transaction
     */
    public function getTransactionRedemptions(int $transactionId)
    {
        $buyerId = auth()->id();
        
        // Verify the transaction belongs to the buyer
        $transaction = IrecProjectTransaction::where('id', $transactionId)
            ->where('buyer_id', $buyerId)
            ->first();

        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found or unauthorized.'], 404);
        }

        $redemptions = $this->redemptionRepository->getTransactionRedemptions($transactionId);

        return response()->json([
            'success' => true,
            'redemptions' => $redemptions->map(function ($redemption) {
                return [
                    'id' => $redemption->id,
                    'redemption_reference' => $redemption->redemption_reference,
                    'quantity_mwh' => $redemption->quantity_mwh,
                    'formatted_quantity' => $redemption->formatted_quantity,
                    'remaining_quantity_mwh' => $redemption->remaining_quantity_mwh,
                    'formatted_remaining_quantity' => $redemption->formatted_remaining_quantity,
                    'redemption_status' => $redemption->redemption_status,
                    'status_badge_class' => $redemption->status_badge_class,
                    'redemption_purpose' => $redemption->redemption_purpose,
                    'notes' => $redemption->notes,
                    'created_at' => $redemption->created_at->format('M d, Y H:i'),
                    'reviewed_at' => $redemption->reviewed_at ? $redemption->reviewed_at->format('M d, Y H:i') : null,
                    'review_notes' => $redemption->review_notes,
                ];
            })
        ]);
    }

    /**
     * Get buyer's redemption history
     */
    public function getRedemptionHistory(Request $request)
    {
        $buyerId = auth()->id();
        $redemptions = $this->redemptionRepository->getBuyerRedemptions($buyerId);

        return response()->json([
            'success' => true,
            'redemptions' => $redemptions->map(function ($redemption) {
                return [
                    'id' => $redemption->id,
                    'redemption_reference' => $redemption->redemption_reference,
                    'transaction_id' => $redemption->transaction_id,
                    'project_name' => $redemption->transaction->project->project_name,
                    'project_id' => $redemption->transaction->project->project_id,
                    'quantity_mwh' => $redemption->quantity_mwh,
                    'formatted_quantity' => $redemption->formatted_quantity,
                    'remaining_quantity_mwh' => $redemption->remaining_quantity_mwh,
                    'formatted_remaining_quantity' => $redemption->formatted_remaining_quantity,
                    'redemption_status' => $redemption->redemption_status,
                    'status_badge_class' => $redemption->status_badge_class,
                    'redemption_purpose' => $redemption->redemption_purpose,
                    'notes' => $redemption->notes,
                    'created_at' => $redemption->created_at->format('M d, Y H:i'),
                    'reviewed_at' => $redemption->reviewed_at ? $redemption->reviewed_at->format('M d, Y H:i') : null,
                    'review_notes' => $redemption->review_notes,
                    'reviewer_name' => $redemption->reviewer ? $redemption->reviewer->name : null,
                ];
            })
        ]);
    }

    /**
     * Get redemption details
     */
    public function getRedemptionDetails($redemptionId)
    {
        $redemption = $this->redemptionRepository->getRedemption($redemptionId);

        if (!$redemption) {
            return response()->json([
                'success' => false,
                'message' => 'Redemption not found'
            ], 404);
        }

        // Check if the redemption belongs to the authenticated user
        if ($redemption->buyer_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'redemption' => [
                'id' => $redemption->id,
                'redemption_reference' => $redemption->redemption_reference,
                'transaction_id' => $redemption->transaction_id,
                'project_name' => $redemption->transaction->project->project_name,
                'project_id' => $redemption->transaction->project->project_id,
                'quantity_mwh' => $redemption->quantity_mwh,
                'formatted_quantity' => $redemption->formatted_quantity,
                'remaining_quantity_mwh' => $redemption->remaining_quantity_mwh,
                'formatted_remaining_quantity' => $redemption->formatted_remaining_quantity,
                'redemption_status' => $redemption->redemption_status,
                'status_badge_class' => $redemption->status_badge_class,
                'redemption_purpose' => $redemption->redemption_purpose,
                'notes' => $redemption->notes,
                'created_at' => $redemption->created_at->format('M d, Y H:i'),
                'reviewed_at' => $redemption->reviewed_at ? $redemption->reviewed_at->format('M d, Y H:i') : null,
                'review_notes' => $redemption->review_notes,
                'reviewer_name' => $redemption->reviewer ? $redemption->reviewer->name : null,
            ]
        ]);
    }

    /**
     * Check if redemption is possible for a transaction
     */
    public function checkRedemptionPossibility($transactionId, Request $request)
    {
        $quantityToRedeem = $request->input('quantity_mwh', 0);
        
        $canRedeem = $this->redemptionRepository->canRedeem($transactionId, $quantityToRedeem);

        return response()->json([
            'success' => true,
            'can_redeem' => $canRedeem['can_redeem'],
            'message' => $canRedeem['message'],
            'remaining_quantity' => $canRedeem['remaining_quantity'] ?? 0,
        ]);
    }
}
