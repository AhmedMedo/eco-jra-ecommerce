<?php

namespace Plugin\Multivendor\Http\Controllers\Buyer\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugin\Multivendor\Repositories\IrecProjectRepository;
use Plugin\Multivendor\Repositories\IrecCartRepository;

class PageController extends Controller
{
    protected $irecRepository;
    protected $cartRepository;

    public function __construct(IrecProjectRepository $irecRepository, IrecCartRepository $cartRepository)
    {
        $this->irecRepository = $irecRepository;
        $this->cartRepository = $cartRepository;
    }

    public function dashboard()
    {
        // Get recent IREC projects for buyer dashboard
        $recentProjects = $this->irecRepository->getProjectsForBuyerDashboard(auth()->id(), 5);
        
        return view('plugin/multivendor::buyer.v2.pages.dashboard', compact('recentProjects'));
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
        return view('plugin/multivendor::buyer.v2.pages.settings');
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
}
