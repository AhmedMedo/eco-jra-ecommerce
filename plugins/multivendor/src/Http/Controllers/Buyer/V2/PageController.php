<?php

namespace Plugin\Multivendor\Http\Controllers\Buyer\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugin\Multivendor\Repositories\IrecProjectRepository;
use Plugin\Multivendor\Repositories\IrecCartRepository;
use Plugin\Multivendor\Repositories\IrecTransactionRepository;

class PageController extends Controller
{
    protected $irecRepository;
    protected $cartRepository;
    protected $transactionRepository;

    public function __construct(
        IrecProjectRepository $irecRepository, 
        IrecCartRepository $cartRepository,
        IrecTransactionRepository $transactionRepository
    ) {
        $this->irecRepository = $irecRepository;
        $this->cartRepository = $cartRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function dashboard()
    {
        // Get completed transactions for buyer dashboard
        $completedTransactions = $this->transactionRepository->getBuyerCompletedTransactions(auth()->id());
        
        return view('plugin/multivendor::buyer.v2.pages.dashboard', compact('completedTransactions'));
    }

    public function marketplace(Request $request)
    {
        $filters = [
            'energy_type' => $request->get('energy_type', 'all'),
            'country' => $request->get('country', 'all'),
            'vintage_year' => $request->get('vintage_year', 'all'),
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
            'certification' => $request->get('certification', 'all'),
            'search' => $request->get('search'),
        ];

        $projects = $this->irecRepository->getFilteredProjects($filters, 12);
        $energyTypes = $this->irecRepository->getAvailableEnergyTypes();
        $countries = $this->irecRepository->getAvailableCountries();
        $vintageYears = $this->irecRepository->getAvailableVintageYears();
        $certificationTypes = $this->irecRepository->getAvailableCertificationTypes();

        return view('plugin/multivendor::buyer.v2.pages.marketplace', compact(
            'projects', 'filters', 'energyTypes', 'countries', 'vintageYears', 'certificationTypes'
        ));
    }

    public function myRequest()
    {
        // Get buyer's watchlist
        $watchlist = $this->irecRepository->getBuyerWatchlist(auth()->id(), 12);
        
        // Get buyer's transaction history
        $transactions = $this->irecRepository->getBuyerTransactions(auth()->id(), 12);

        return view('plugin/multivendor::buyer.v2.pages.my-request', compact('watchlist', 'transactions'));
    }

    public function accountReview()
    {
        return view('plugin/multivendor::buyer.v2.pages.account-review');
    }

    public function projectDetail($id)
    {
        $project = $this->irecRepository->findByProjectId($id);
        if (!$project) {
            $project = $this->irecRepository->find((int) $id);
        }
        if (!$project) {
            abort(404, 'Project not found');
        }
        
        $isInWatchlist = false;
        if (auth()->check()) {
            $isInWatchlist = $this->irecRepository->watchlistModel
                ->where('project_id', $project->id)
                ->where('buyer_id', auth()->id())
                ->exists();
        }
        
        return view('plugin/multivendor::buyer.v2.pages.project-detail', compact(
            'project', 'isInWatchlist'
        ));
    }

    public function certificates()
    {
        return view('plugin/multivendor::buyer.v2.pages.certificates');
    }

    public function settings()
    {
        $user = auth()->user();
        $kycDocuments = \Plugin\Multivendor\Models\BuyerKycDocument::where('user_id', $user->id)
            ->with('file')
            ->get();
            
        return view('plugin/multivendor::buyer.v2.pages.settings', compact('user', 'kycDocuments'));
    }

    /**
     * Update buyer profile
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'company_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'vat_number' => 'nullable|string|max:100',
        ]);

        try {
            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'company_name' => $validated['company_name'],
                'phone' => $validated['phone'],
                'vat_number' => $validated['vat_number'],
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }

    /**
     * Upload new KYC documents
     */
    public function uploadKycDocuments(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'kyc_files.*' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // 10MB max
        ]);

        try {
            \DB::beginTransaction();

            foreach ($request->file('kyc_files') as $file) {
                if ($file->isValid()) {
                    // Use the existing file upload system
                    $file_id = \saveFileInStorage($file, 'buyer-kyc');
                    
                    if ($file_id) {
                        // Create KYC document record
                        \Plugin\Multivendor\Models\BuyerKycDocument::create([
                            'user_id' => $user->id,
                            'file_id' => $file_id,
                            'document_type' => $this->detectDocumentType($file),
                            'status' => 'pending'
                        ]);
                    }
                }
            }

            \DB::commit();

            return redirect()->back()->with('success', 'Documents uploaded successfully! They will be reviewed by our team.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to upload documents. Please try again.');
        }
    }

    /**
     * Replace existing KYC document
     */
    public function replaceKycDocument(Request $request, $documentId)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'kyc_file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // 10MB max
        ]);

        try {
            $document = \Plugin\Multivendor\Models\BuyerKycDocument::where('id', $documentId)
                ->where('user_id', $user->id)
                ->firstOrFail();

            \DB::beginTransaction();

            $file = $request->file('kyc_file');
            if ($file->isValid()) {
                // Use the existing file upload system
                $file_id = \saveFileInStorage($file, 'buyer-kyc');
                
                if ($file_id) {
                    // Update the document with new file
                    $document->update([
                        'file_id' => $file_id,
                        'document_type' => $this->detectDocumentType($file),
                        'status' => 'pending' // Reset status to pending for review
                    ]);
                }
            }

            \DB::commit();

            return redirect()->back()->with('success', 'Document replaced successfully! It will be reviewed by our team.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to replace document. Please try again.');
        }
    }

    /**
     * Detect document type based on file name or content
     */
    private function detectDocumentType($file)
    {
        $filename = strtolower($file->getClientOriginalName());
        
        if (strpos($filename, 'license') !== false || strpos($filename, 'business') !== false) {
            return 'business_license';
        } elseif (strpos($filename, 'id') !== false || strpos($filename, 'identity') !== false) {
            return 'id_card';
        } elseif (strpos($filename, 'passport') !== false) {
            return 'passport';
        } elseif (strpos($filename, 'tax') !== false || strpos($filename, 'vat') !== false) {
            return 'tax_certificate';
        } else {
            return 'other';
        }
    }

    // ==================== AJAX METHODS ====================

    /**
     * Add project to watchlist
     */
    public function addToWatchlist(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:tl_multivendor_irec_projects,id'
        ]);

        $success = $this->irecRepository->addToWatchlist(
            $request->project_id,
            auth()->id()
        );

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Added to watchlist' : 'Already in watchlist'
        ]);
    }

    /**
     * Remove project from watchlist
     */
    public function removeFromWatchlist(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:tl_multivendor_irec_projects,id'
        ]);

        $success = $this->irecRepository->removeFromWatchlist(
            $request->project_id,
            auth()->id()
        );

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Removed from watchlist' : 'Project not in watchlist'
        ]);
    }

    /**
     * Search projects
     */
    public function searchProjects(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:2'
        ]);

        $projects = $this->irecRepository->searchProjects($request->search, 12);

        return response()->json([
            'success' => true,
            'projects' => $projects,
            'html' => view('plugin/multivendor::buyer.v2.partials.project-cards', compact('projects'))->render()
        ]);
    }

    /**
     * Get filter options
     */
    public function getFilterOptions()
    {
        $energyTypes = $this->irecRepository->getAvailableEnergyTypes();
        $countries = $this->irecRepository->getAvailableCountries();
        $vintageYears = $this->irecRepository->getAvailableVintageYears();
        $certificationTypes = $this->irecRepository->getAvailableCertificationTypes();

        return response()->json([
            'energy_types' => $energyTypes,
            'countries' => $countries,
            'vintage_years' => $vintageYears,
            'certification_types' => $certificationTypes,
        ]);
    }

    public function exportProjects(Request $request)
    {
        $filters = [
            'energy_type' => $request->get('energy_type', 'all'),
            'country' => $request->get('country', 'all'),
            'vintage_year' => $request->get('vintage_year', 'all'),
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
            'certification' => $request->get('certification', 'all'),
            'search' => $request->get('search'),
        ];

        $projects = $this->irecRepository->getFilteredProjects($filters, 1000); // Get more projects for export

        $filename = 'irec-projects-' . date('Y-m-d-H-i-s') . '.xlsx';

        return response()->streamDownload(function () use ($projects) {
            $handle = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($handle, [
                'Project ID',
                'Project Name',
                'Energy Type',
                'Country',
                'Vintage Year',
                'Capacity (MWh)',
                'Available (MWh)',
                'Total IRECs',
                'Price per MWh (EGP)',
                'Status',
                'Technology',
                'City',
                'Region'
            ]);

            // Add data rows
            foreach ($projects as $project) {
                fputcsv($handle, [
                    $project->project_id,
                    $project->project_name,
                    ucfirst($project->energy_type),
                    $project->country,
                    $project->vintage_year,
                    $project->project_capacity,
                    $project->available_quantity_mwh,
                    $project->total_irecs,
                    $project->price_per_mwh,
                    ucfirst($project->status),
                    $project->technology,
                    $project->city,
                    $project->region
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function saveFilter(Request $request)
    {
        $request->validate([
            'filter_name' => 'required|string|max:255',
        ]);

        $filters = [
            'energy_type' => $request->get('energy_type', 'all'),
            'country' => $request->get('country', 'all'),
            'vintage_year' => $request->get('vintage_year', 'all'),
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
            'certification' => $request->get('certification', 'all'),
            'search' => $request->get('search'),
        ];

        $savedFilter = $this->irecRepository->saveFilter(
            auth()->id(),
            $request->filter_name,
            $filters
        );

        return response()->json([
            'success' => true,
            'message' => 'Filter saved successfully',
            'filter' => $savedFilter
        ]);
    }

    public function loadFilter($filterId)
    {
        $filter = $this->irecRepository->loadSavedFilter($filterId);
        
        if (!$filter || $filter->buyer_id !== auth()->id()) {
            abort(404, 'Filter not found');
        }

        return redirect()->route('plugin.multivendor.buyer.v2.marketplace', $filter->filter_data);
    }

    public function deleteFilter($filterId)
    {
        $deleted = $this->irecRepository->deleteSavedFilter($filterId, auth()->id());
        
        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Filter deleted successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Filter not found'
        ], 404);
    }

    public function getSavedFilters()
    {
        $savedFilters = $this->irecRepository->getBuyerSavedFilters(auth()->id());
        
        return response()->json([
            'filters' => $savedFilters
        ]);
    }

    // ==================== CART METHODS ====================

    /**
     * Add IREC project to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:tl_multivendor_irec_projects,id',
            'quantity_mwh' => 'required|numeric|min:0.01',
        ]);

        $result = $this->cartRepository->addToCart(
            auth()->id(),
            $request->project_id,
            $request->quantity_mwh
        );

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'IREC added to cart successfully',
                'cart_summary' => $this->cartRepository->getCartSummary(auth()->id())
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to add IREC to cart'
        ], 400);
    }

    /**
     * Get cart items for AJAX
     */
    public function getCartItems()
    {
        $cartItems = $this->cartRepository->getCartItems(auth()->id());
        $cartSummary = $this->cartRepository->getCartSummary(auth()->id());
        
        return response()->json([
            'cart_items' => $cartItems,
            'cart_summary' => $cartSummary
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function updateCartItem(Request $request)
    {
        $request->validate([
            'uid' => 'required|string',
            'quantity_mwh' => 'required|numeric|min:0.01',
        ]);

        $result = $this->cartRepository->updateCartItem(
            auth()->id(),
            $request->uid,
            $request->quantity_mwh
        );

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'cart_summary' => $this->cartRepository->getCartSummary(auth()->id())
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update cart'
        ], 400);
    }

    /**
     * Remove item from cart
     */
    public function removeCartItem(Request $request)
    {
        $request->validate([
            'uid' => 'required|string',
        ]);

        $result = $this->cartRepository->removeCartItem(auth()->id(), $request->uid);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart',
                'cart_summary' => $this->cartRepository->getCartSummary(auth()->id())
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to remove item'
        ], 400);
    }

    /**
     * Show cart page
     */
    public function cart()
    {
        $cartItems = $this->cartRepository->getCartItems(auth()->id());
        $cartSummary = $this->cartRepository->getCartSummary(auth()->id());
        
        return view('plugin/multivendor::buyer.v2.pages.cart', compact('cartItems', 'cartSummary'));
    }

    // ==================== TRANSACTION HISTORY METHODS ====================

    /**
     * Show transaction history page
     */
    public function transactionHistory(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        
        $filters = [
            'status' => $request->get('status'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'project_name' => $request->get('project_name'),
            'amount_min' => $request->get('amount_min'),
            'amount_max' => $request->get('amount_max'),
        ];

        // Debug: Check current user and total transactions
        $currentUserId = auth()->id();
        $totalTransactions = \Plugin\Multivendor\Models\IrecProjectTransaction::count();
        $userTransactions = \Plugin\Multivendor\Models\IrecProjectTransaction::where('buyer_id', $currentUserId)->count();
        
        // If no transactions for current user, create some test data
        if ($userTransactions === 0 && $totalTransactions === 0) {
            $this->createTestTransactions($currentUserId);
        }

        $transactions = $this->transactionRepository->getBuyerTransactionHistory(
            $currentUserId, 
            $filters, 
            $perPage, 
            $page
        );

        $transactionStats = $this->transactionRepository->getBuyerTransactionStats($currentUserId);
        $availableStatuses = $this->transactionRepository->getAvailableStatuses();

        return view('plugin/multivendor::buyer.v2.pages.transaction-history', compact(
            'transactions', 
            'transactionStats', 
            'availableStatuses',
            'filters'
        ));
    }

    /**
     * Create test transactions for the current user
     */
    private function createTestTransactions($userId)
    {
        $projects = \Plugin\Multivendor\Models\IrecProject::take(5)->get();
        
        if ($projects->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'completed', 'cancelled'];
        $transactions = [];

        for ($i = 0; $i < 10; $i++) {
            $project = $projects->random();
            $quantity = rand(5, 50) + (rand(0, 99) / 100); // Random quantity with decimals
            $pricePerMwh = rand(15, 35) + (rand(0, 99) / 100); // Random price with decimals
            $totalAmount = $quantity * $pricePerMwh;
            $status = $statuses[array_rand($statuses)];
            
            // Random dates in the last 6 months
            $daysAgo = rand(1, 180);
            $transactionDate = now()->subDays($daysAgo);

            $transactions[] = [
                'project_id' => $project->id,
                'buyer_id' => $userId,
                'quantity_mwh' => round($quantity, 2),
                'price_per_mwh' => round($pricePerMwh, 2),
                'total_amount' => round($totalAmount, 2),
                'transaction_status' => $status,
                'transaction_date' => $transactionDate,
                'created_at' => $transactionDate,
                'updated_at' => $transactionDate,
            ];
        }

        \Plugin\Multivendor\Models\IrecProjectTransaction::insert($transactions);
    }

    /**
     * Show transaction details
     */
    public function transactionDetails($transactionId)
    {
        $transaction = $this->transactionRepository->getBuyerTransaction(auth()->id(), $transactionId);
        
        if (!$transaction) {
            abort(404, 'Transaction not found');
        }

        return view('plugin/multivendor::buyer.v2.pages.transaction-details', compact('transaction'));
    }

    /**
     * Export transaction history
     */
    public function exportTransactionHistory(Request $request)
    {
        $filters = [
            'status' => $request->get('status'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'project_name' => $request->get('project_name'),
            'amount_min' => $request->get('amount_min'),
            'amount_max' => $request->get('amount_max'),
        ];

        $transactions = $this->transactionRepository->getTransactionsForExport(auth()->id(), $filters);

        $csvData = "Transaction ID,Date,Project Name,Quantity (MWh),Price per MWh (EGP),Total Amount (EGP),Status\n";
        
        foreach ($transactions as $transaction) {
            $csvData .= sprintf(
                "%d,%s,%s,%.2f,%.2f,%.2f,%s\n",
                $transaction->id,
                $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d H:i:s') : '',
                '"' . ($transaction->project->project_name ?? 'N/A') . '"',
                $transaction->quantity_mwh,
                $transaction->price_per_mwh,
                $transaction->total_amount,
                ucfirst($transaction->transaction_status)
            );
        }

        $filename = 'transaction_history_' . auth()->id() . '_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        return response($csvData)
            ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Get transaction statistics for AJAX
     */
    public function getTransactionStats()
    {
        $stats = $this->transactionRepository->getBuyerTransactionStats(auth()->id());
        return response()->json($stats);
    }

    /**
     * Search transactions by project name (AJAX)
     */
    public function searchTransactions(Request $request)
    {
        $projectName = $request->get('q', '');
        $limit = $request->get('limit', 10);

        $transactions = $this->transactionRepository->searchByProjectName(auth()->id(), $projectName, $limit);

        return response()->json([
            'transactions' => $transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'project_name' => $transaction->project->project_name ?? 'N/A',
                    'quantity_mwh' => $transaction->quantity_mwh,
                    'total_amount' => $transaction->total_amount,
                    'status' => $transaction->transaction_status,
                    'transaction_date' => $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d H:i:s') : null,
                ];
            })
        ]);
    }
}
