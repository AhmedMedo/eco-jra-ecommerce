<?php

namespace Plugin\Multivendor\Repositories;

use Illuminate\Support\Collection;
use Plugin\Multivendor\Models\IrecProject;
use Plugin\Multivendor\Models\IrecProjectWatchlist;
use Plugin\Multivendor\Models\IrecProjectTransaction;
use Plugin\Multivendor\Models\SavedFilter;

class IrecProjectRepository
{
    public $model;
    public $watchlistModel;
    protected $transactionModel;

    public function __construct()
    {
        $this->model = new IrecProject();
        $this->watchlistModel = new IrecProjectWatchlist();
        $this->transactionModel = new IrecProjectTransaction();
    }

    /**
     * Get all projects with pagination
     */
    public function getAll(int $perPage = 12): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model
            ->with(['seller', 'mainImage', 'certifications'])
            ->where('status', 'active')
            ->where('available_quantity_mwh', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get filtered projects
     */
    public function getFilteredProjects(array $filters, int $perPage = 12): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = $this->model
            ->with(['seller', 'mainImage', 'certifications'])
            ->where('status', 'active')
            ->where('available_quantity_mwh', '>', 0);

        // Apply filters
        if (!empty($filters['energy_type']) && $filters['energy_type'] !== 'all') {
            $query->where('energy_type', $filters['energy_type']);
        }

        if (!empty($filters['country']) && $filters['country'] !== 'all') {
            $query->where('country', $filters['country']);
        }

        if (!empty($filters['vintage_year']) && $filters['vintage_year'] !== 'all') {
            $query->where('vintage_year', $filters['vintage_year']);
        }

        if (!empty($filters['certification']) && $filters['certification'] !== 'all') {
            $query->whereHas('certifications', function ($q) use ($filters) {
                $q->where('certification_type', $filters['certification']);
            });
        }

        if (!empty($filters['min_price'])) {
            $query->where('price_per_mwh', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price_per_mwh', '<=', $filters['max_price']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('project_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('technology', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Find project by ID
     */
    public function find(int $id): ?IrecProject
    {
        return $this->model
            ->with(['seller', 'mainImage', 'certifications', 'images'])
            ->find($id);
    }

    /**
     * Find project by project_id
     */
    public function findByProjectId(string $projectId): ?IrecProject
    {
        return $this->model
            ->with(['seller', 'mainImage', 'certifications', 'images'])
            ->where('project_id', $projectId)
            ->first();
    }

    /**
     * Get projects for buyer dashboard
     */
    public function getProjectsForBuyerDashboard(int $buyerId, int $limit = 5): Collection
    {
        return $this->model
            ->with(['seller', 'mainImage'])
            ->where('status', 'active')
            ->where('available_quantity_mwh', '>', 0)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get buyer watchlist
     */
    public function getBuyerWatchlist(int $buyerId, int $perPage = 12): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->watchlistModel
            ->with(['project.seller', 'project.mainImage'])
            ->where('buyer_id', $buyerId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get buyer transactions
     */
    public function getBuyerTransactions(int $buyerId, int $perPage = 12): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->transactionModel
            ->with(['project.seller', 'project.mainImage'])
            ->where('buyer_id', $buyerId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Add project to watchlist
     */
    public function addToWatchlist(int $projectId, int $buyerId): bool
    {
        $exists = $this->watchlistModel
            ->where('project_id', $projectId)
            ->where('buyer_id', $buyerId)
            ->exists();

        if (!$exists) {
            $this->watchlistModel->create([
                'project_id' => $projectId,
                'buyer_id' => $buyerId,
            ]);
            return true;
        }

        return false;
    }

    /**
     * Remove project from watchlist
     */
    public function removeFromWatchlist(int $projectId, int $buyerId): bool
    {
        $deleted = $this->watchlistModel
            ->where('project_id', $projectId)
            ->where('buyer_id', $buyerId)
            ->delete();

        return $deleted > 0;
    }

    /**
     * Search projects
     */
    public function searchProjects(string $search, int $perPage = 12): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model
            ->with(['seller', 'mainImage'])
            ->where('status', 'active')
            ->where('available_quantity_mwh', '>', 0)
            ->where(function ($query) use ($search) {
                $query->where('project_name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('technology', 'like', "%{$search}%")
                      ->orWhere('country', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get available energy types
     */
    public function getAvailableEnergyTypes(): Collection
    {
        return $this->model
            ->where('status', 'active')
            ->distinct()
            ->pluck('energy_type')
            ->sort();
    }

    /**
     * Get available countries
     */
    public function getAvailableCountries(): Collection
    {
        return $this->model
            ->where('status', 'active')
            ->distinct()
            ->pluck('country')
            ->sort();
    }

    /**
     * Get available vintage years
     */
    public function getAvailableVintageYears(): Collection
    {
        return $this->model
            ->where('status', 'active')
            ->distinct()
            ->pluck('vintage_year')
            ->sort()
            ->reverse();
    }

    /**
     * Get available certification types
     */
    public function getAvailableCertificationTypes(): Collection
    {
        return $this->model
            ->whereHas('certifications')
            ->with('certifications')
            ->get()
            ->pluck('certifications.*.certification_type')
            ->flatten()
            ->unique()
            ->sort();
    }

    /**
     * Get marketplace statistics
     */
    public function getMarketplaceStats(): array
    {
        $totalProjects = $this->model->where('status', 'active')->count();
        $totalCapacity = $this->model->where('status', 'active')->sum('project_capacity');
        $totalAvailable = $this->model->where('status', 'active')->sum('available_quantity_mwh');
        $countriesCount = $this->model->where('status', 'active')->distinct('country')->count();

        return [
            'total_projects' => $totalProjects,
            'total_capacity' => $totalCapacity,
            'total_available' => $totalAvailable,
            'countries_count' => $countriesCount,
        ];
    }

    /**
     * Create new project
     */
    public function create(array $data): IrecProject
    {
        return $this->model->create($data);
    }

    /**
     * Update project
     */
    public function update(int $id, array $data): bool
    {
        $project = $this->model->find($id);
        if ($project) {
            return $project->update($data);
        }
        return false;
    }

    /**
     * Delete project
     */
    public function delete(int $id): bool
    {
        $project = $this->model->find($id);
        if ($project) {
            return $project->delete();
        }
        return false;
    }

    /**
     * Save filter for buyer
     */
    public function saveFilter(int $buyerId, string $filterName, array $filterData): SavedFilter
    {
        return SavedFilter::create([
            'buyer_id' => $buyerId,
            'filter_name' => $filterName,
            'filter_data' => $filterData,
        ]);
    }

    /**
     * Get buyer's saved filters
     */
    public function getBuyerSavedFilters(int $buyerId): Collection
    {
        return SavedFilter::where('buyer_id', $buyerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Load saved filter by ID
     */
    public function loadSavedFilter(int $filterId): ?SavedFilter
    {
        return SavedFilter::find($filterId);
    }

    /**
     * Delete saved filter
     */
    public function deleteSavedFilter(int $filterId, int $buyerId): bool
    {
        $filter = SavedFilter::where('id', $filterId)
            ->where('buyer_id', $buyerId)
            ->first();
            
        if ($filter) {
            return $filter->delete();
        }
        return false;
    }
}
