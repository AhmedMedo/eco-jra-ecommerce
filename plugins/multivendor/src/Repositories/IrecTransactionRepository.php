<?php

namespace Plugin\Multivendor\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Plugin\Multivendor\Models\IrecProjectTransaction;
use Carbon\Carbon;

class IrecTransactionRepository
{
    /**
     * Get transaction history for a buyer with pagination and filters
     */
    public function getBuyerTransactionHistory(
        int $buyerId, 
        array $filters = [], 
        int $perPage = 10, 
        int $page = 1
    ): LengthAwarePaginator {
        $query = IrecProjectTransaction::with(['project', 'buyer'])
            ->where('buyer_id', $buyerId);

        // Apply filters
        if (!empty($filters['status'])) {
            $query->where('transaction_status', $filters['status']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('transaction_date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('transaction_date', '<=', $filters['date_to']);
        }

        if (!empty($filters['project_name'])) {
            $query->whereHas('project', function ($q) use ($filters) {
                $q->where('project_name', 'like', '%' . $filters['project_name'] . '%');
            });
        }

        if (!empty($filters['amount_min'])) {
            $query->where('total_amount', '>=', $filters['amount_min']);
        }

        if (!empty($filters['amount_max'])) {
            $query->where('total_amount', '<=', $filters['amount_max']);
        }

        return $query->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Get transaction statistics for a buyer
     */
    public function getBuyerTransactionStats(int $buyerId): array
    {
        $transactions = IrecProjectTransaction::where('buyer_id', $buyerId);

        $totalTransactions = $transactions->count();
        $completedTransactions = $transactions->where('transaction_status', 'completed')->count();
        $pendingTransactions = $transactions->where('transaction_status', 'pending')->count();
        $cancelledTransactions = $transactions->where('transaction_status', 'cancelled')->count();

        $totalSpent = $transactions->where('transaction_status', 'completed')->sum('total_amount');
        $totalQuantity = $transactions->where('transaction_status', 'completed')->sum('quantity_mwh');

        // Get monthly statistics for current year
        $monthlyStats = $transactions->where('transaction_status', 'completed')
            ->whereYear('transaction_date', Carbon::now()->year)
            ->selectRaw('MONTH(transaction_date) as month, SUM(total_amount) as amount, SUM(quantity_mwh) as quantity, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('amount', 'month')
            ->toArray();

        return [
            'total_transactions' => $totalTransactions,
            'completed_transactions' => $completedTransactions,
            'pending_transactions' => $pendingTransactions,
            'cancelled_transactions' => $cancelledTransactions,
            'total_spent' => $totalSpent,
            'total_quantity_purchased' => $totalQuantity,
            'monthly_stats' => $monthlyStats,
            'completion_rate' => $totalTransactions > 0 ? round(($completedTransactions / $totalTransactions) * 100, 1) : 0,
        ];
    }

    /**
     * Get a specific transaction by ID for a buyer
     */
    public function getBuyerTransaction(int $buyerId, int $transactionId): ?IrecProjectTransaction
    {
        return IrecProjectTransaction::with(['project', 'buyer'])
            ->where('buyer_id', $buyerId)
            ->where('id', $transactionId)
            ->first();
    }

    /**
     * Get available transaction status options
     */
    public function getAvailableStatuses(): Collection
    {
        return collect([
            'pending' => 'Pending',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ]);
    }

    /**
     * Get recent transactions for dashboard
     */
    public function getRecentTransactions(int $buyerId, int $limit = 5): Collection
    {
        return IrecProjectTransaction::with(['project'])
            ->where('buyer_id', $buyerId)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Search transactions by project name
     */
    public function searchByProjectName(int $buyerId, string $projectName, int $limit = 10): Collection
    {
        return IrecProjectTransaction::with(['project'])
            ->where('buyer_id', $buyerId)
            ->whereHas('project', function ($query) use ($projectName) {
                $query->where('project_name', 'like', '%' . $projectName . '%');
            })
            ->orderBy('transaction_date', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get transactions for export
     */
    public function getTransactionsForExport(int $buyerId, array $filters = []): Collection
    {
        $query = IrecProjectTransaction::with(['project', 'buyer'])
            ->where('buyer_id', $buyerId);

        // Apply same filters as in getBuyerTransactionHistory
        if (!empty($filters['status'])) {
            $query->where('transaction_status', $filters['status']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('transaction_date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('transaction_date', '<=', $filters['date_to']);
        }

        if (!empty($filters['project_name'])) {
            $query->whereHas('project', function ($q) use ($filters) {
                $q->where('project_name', 'like', '%' . $filters['project_name'] . '%');
            });
        }

        if (!empty($filters['amount_min'])) {
            $query->where('total_amount', '>=', $filters['amount_min']);
        }

        if (!empty($filters['amount_max'])) {
            $query->where('total_amount', '<=', $filters['amount_max']);
        }

        return $query->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Create a new transaction from cart checkout
     */
    public function createTransactionFromCart(int $buyerId, array $cartItems, array $transactionData = []): Collection
    {
        $transactions = collect();

        foreach ($cartItems as $cartItem) {
            $transaction = IrecProjectTransaction::create([
                'project_id' => $cartItem['project_id'],
                'buyer_id' => $buyerId,
                'quantity_mwh' => $cartItem['quantity_mwh'],
                'price_per_mwh' => $cartItem['price_per_mwh'],
                'total_amount' => $cartItem['total_amount'],
                'transaction_status' => $transactionData['status'] ?? 'pending',
                'transaction_date' => $transactionData['transaction_date'] ?? Carbon::now(),
            ]);

            $transactions->push($transaction);
        }

        return $transactions;
    }
}
