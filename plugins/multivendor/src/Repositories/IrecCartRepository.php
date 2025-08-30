<?php

namespace Plugin\Multivendor\Repositories;

use Illuminate\Support\Collection;
use Plugin\Multivendor\Models\IrecCartItem;
use Plugin\Multivendor\Models\IrecProject;
use Illuminate\Support\Facades\DB;

class IrecCartRepository
{
    /**
     * Add IREC project to cart
     */
    public function addToCart(int $buyerId, int $projectId, float $quantityMwh): bool
    {
        try {
            DB::beginTransaction();
            
            $project = IrecProject::find($projectId);
            if (!$project) {
                throw new \Exception('Project not found');
            }
            
            // Check if project already in cart
            $existingItem = IrecCartItem::where('buyer_id', $buyerId)
                ->where('project_id', $projectId)
                ->first();
            
            if ($existingItem) {
                // Update quantity
                $newQuantity = $existingItem->quantity_mwh + $quantityMwh;
                
                // Check availability
                if ($newQuantity > $project->available_quantity_mwh) {
                    throw new \Exception('Requested quantity exceeds available amount');
                }
                
                $existingItem->quantity_mwh = $newQuantity;
                $existingItem->save();
            } else {
                // Check availability
                if ($quantityMwh > $project->available_quantity_mwh) {
                    throw new \Exception('Requested quantity exceeds available amount');
                }
                
                // Create new cart item
                IrecCartItem::create([
                    'buyer_id' => $buyerId,
                    'project_id' => $projectId,
                    'quantity_mwh' => $quantityMwh,
                    'price_per_mwh' => $project->price_per_mwh,
                    'project_snapshot' => [
                        'project_name' => $project->project_name,
                        'project_id' => $project->project_id,
                        'energy_type' => $project->energy_type,
                        'country' => $project->country,
                        'vintage_year' => $project->vintage_year,
                        'project_image' => $project->project_image,
                    ]
                ]);
            }
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    
    /**
     * Get buyer's cart items
     */
    public function getCartItems(int $buyerId): Collection
    {
        return IrecCartItem::with('project')
            ->where('buyer_id', $buyerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    /**
     * Update cart item quantity
     */
    public function updateCartItem(int $buyerId, string $uid, float $quantityMwh): bool
    {
        try {
            $cartItem = IrecCartItem::where('buyer_id', $buyerId)
                ->where('uid', $uid)
                ->first();
            
            if (!$cartItem) {
                return false;
            }
            
            // Check availability
            if ($quantityMwh > $cartItem->project->available_quantity_mwh) {
                throw new \Exception('Requested quantity exceeds available amount');
            }
            
            $cartItem->quantity_mwh = $quantityMwh;
            $cartItem->save();
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Remove cart item
     */
    public function removeCartItem(int $buyerId, string $uid): bool
    {
        try {
            $cartItem = IrecCartItem::where('buyer_id', $buyerId)
                ->where('uid', $uid)
                ->first();
            
            if ($cartItem) {
                $cartItem->delete();
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Get cart summary
     */
    public function getCartSummary(int $buyerId): array
    {
        $cartItems = $this->getCartItems($buyerId);
        
        return [
            'total_items' => $cartItems->count(),
            'total_quantity' => $cartItems->sum('quantity_mwh'),
            'total_amount' => $cartItems->sum('total_amount'),
            'formatted_total' => 'EGP ' . number_format($cartItems->sum('total_amount'), 2),
        ];
    }
    
    /**
     * Clear cart
     */
    public function clearCart(int $buyerId): bool
    {
        try {
            IrecCartItem::where('buyer_id', $buyerId)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
