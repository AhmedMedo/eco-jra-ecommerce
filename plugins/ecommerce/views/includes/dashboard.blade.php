@php
    $order_repository = new Plugin\Ecommerce\Repositories\OrderRepository();

    $report_repository = new Plugin\Ecommerce\Repositories\ReportRepository();

    $business_stats = $report_repository->businessStats();

    $recent_orders = \Plugin\Ecommerce\Models\Orders::with(['customer_info', 'guest_customer'])
        ->select('order_code', 'id', 'created_at', 'total_payable_amount', 'customer_id')
        ->orderBy('id', 'DESC')
        ->take(6)
        ->get();
    $top_customers = \Plugin\Ecommerce\Models\Customers::withCount('orders')
        ->orderBy('orders_count', 'DESC')
        ->take(5)
        ->get();

    $top_selling_products = \Plugin\Ecommerce\Models\Product::select(['id', 'name', 'permalink', 'thumbnail_image'])
        ->withCount(['orders'])
        ->withSum('orders', 'unit_price')
        ->withSum('orders', 'quantity')
        ->orderBy('orders_sum_quantity', 'DESC')
        ->take(5)
        ->get();

    $popular_products = \Plugin\Ecommerce\Models\Product::select(['id', 'name', 'permalink', 'thumbnail_image'])
        ->withCount(['reviews'])
        ->withAvg('reviews', 'rating')
        ->orderBy('reviews_avg_rating', 'DESC')
        ->take(5)
        ->get();
    if (isActivePlugin('multivendor')) {
        $top_selling_stores = \Plugin\Multivendor\Models\SellerShop::select(['id', 'shop_name', 'logo', 'shop_slug'])
            ->withCount(['orders'])
            ->withSum('orders', 'unit_price')
            ->withSum('orders', 'quantity')
            ->orderBy('orders_sum_quantity', 'DESC')
            ->take(5)
            ->get();

        $popular_stores = \Plugin\Multivendor\Models\SellerShop::select(['id', 'shop_name', 'logo', 'shop_slug'])
            ->withCount(['followers'])
            ->orderBy('followers_count', 'DESC')
            ->take(5)
            ->get();
    }
    $category_data = ['tl_com_categories.id', DB::raw('GROUP_CONCAT(DISTINCT(tl_com_categories.icon)) as icon'), DB::raw('sum(tl_com_ordered_products.quantity * tl_com_ordered_products.unit_price) as total_sales'), DB::raw('sum(tl_com_ordered_products.quantity ) as number_of_sales')];
    $top_categories = DB::table('tl_com_categories')
        ->leftjoin('tl_com_product_has_categories', 'tl_com_product_has_categories.category_id', 'tl_com_categories.id')
        ->leftjoin('tl_com_ordered_products', 'tl_com_ordered_products.product_id', 'tl_com_product_has_categories.product_id')
        ->groupBy('tl_com_categories.id')
        ->select($category_data)
        ->orderBy(DB::raw('sum(tl_com_ordered_products.quantity )'), 'DESC')
        ->take(5)
        ->get();

    $top_categories = $top_categories->map(function ($category, $key) {
        $category_details = \Plugin\Ecommerce\Models\ProductCategory::select('id', 'name', 'permalink')
            ->where('id', $category->id)
            ->first();
        if ($category_details != null) {
            return [
                'id' => $category->id,
                'icon' => $category->icon,
                'name' => $category_details->translation('name', getLocale()),
                'total_sales' => $category->total_sales,
                'number_of_sales' => $category->number_of_sales,
            ];
        }
    });

    $brands_data = ['tl_com_brands.id', DB::raw('GROUP_CONCAT(DISTINCT(tl_com_brands.logo)) as logo'), DB::raw('sum(tl_com_ordered_products.quantity * tl_com_ordered_products.unit_price) as total_sales'), DB::raw('sum(tl_com_ordered_products.quantity ) as number_of_sales')];
    $top_brands = DB::table('tl_com_brands')
        ->leftjoin('tl_com_products', 'tl_com_products.brand', 'tl_com_brands.id')
        ->leftjoin('tl_com_ordered_products', 'tl_com_ordered_products.product_id', 'tl_com_products.id')
        ->groupBy('tl_com_brands.id')
        ->select($brands_data)
        ->orderBy(DB::raw('sum(tl_com_ordered_products.quantity )'), 'DESC')
        ->take(6)
        ->get();

    $top_brands = $top_brands->map(function ($brand, $key) {
        $brand_details = \Plugin\Ecommerce\Models\ProductBrand::select('id', 'name', 'permalink')
            ->where('id', $brand->id)
            ->first();
        if ($brand_details != null) {
            return [
                'id' => $brand->id,
                'logo' => $brand->logo,
                'name' => $brand_details->translation('name', getLocale()),
                'total_sales' => $brand->total_sales,
                'number_of_sales' => $brand->number_of_sales,
            ];
        }
    });

@endphp
@push('head')
    {{-- Push custom script or style into head tag --}}
    <link href="{{ asset('web-assets/backend/css/ratings.css') }}" rel="stylesheet" />
    <style>
        .overflow-text {
            display: block;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dash-image {
            min-width: 60px !important;
        }

        .order-couter-item {
            padding: 13px 0px;
        }

        .apexcharts-toolbar {
            top: -46px !important;
        }

        .img-20 {
            width: 20px !important;
            height: 20px !important;
        }

        .fixed-card {
            max-height: 490px !important;
            min-height: 490px !important;
        }

        .color-icon {
            color: #d51243;
        }

        .custom-card {
            border: 1px solid #d5124314 !important;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .05) !important;
            transition: all .3s ease !important;
        }
    </style>
@endpush
@push('script')
    {{-- Push custom script or style bottom of body tag --}}
@endpush
<!--Business Stats-->
<div class="card mb-30">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4>{{ __('Business Insight') }}</h4>
        <div class="section-box">
            <select class="form-control" id="business_insight_change">
                <option value="over_all">{{ translate('Overall statistics') }}</option>
                <option value="today">{{ translate('Todays Statistics') }}</option>
                <option value="month">{{ translate('This Months Statistics') }}</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!--Total Customers-->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="state">
                        <div class="d-flex justify-content-between px-2">
                            <div class="state-content">
                                <p class="font-14 mb-2 bold black">{{ translate('Total Customers') }}</p>
                                <h3 class="total_customer">{{ $business_stats['total_customers'] }}</h3>
                            </div>
                            <i class="icofont-users-alt-5 font-40 color-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--End total customers-->
            <!--Total Orders-->
            <div class="col-xl-3 col-sm-6">
                <div class="card custom-card mb-20">
                    <div class="state">
                        <div class="d-flex justify-content-between px-2">
                            <div class="state-content ">
                                <p class="font-14 mb-2 bold black">{{ translate('Total Orders') }}</p>
                                <h3 class="total_orders">
                                    {{ $business_stats['total_orders'] }}
                                </h3>
                            </div>
                            <i class="icofont-chart-histogram-alt font-40 color-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--End total Orders-->
            <!--Total Products-->
            <div class="col-xl-3 col-sm-6">
                <div class="card custom-card mb-20">
                    <div class="state">
                        <div class="d-flex justify-content-between px-2">
                            <div class="state-content bold black">
                                <p class="font-14 mb-2">{{ translate('Total Products') }}</p>
                                <h3 class="total_products">{{ $business_stats['total_products'] }}</h3>
                            </div>
                            <i class="icofont-bucket1 font-40 color-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Products-->
            <!--Total Sales-->
            <div class="col-xl-3 col-sm-6">
                <div class="card custom-card mb-20">
                    <div class="state">
                        <div class="d-flex justify-content-between px-2">
                            <div class="state-content">
                                <p class="font-14 mb-2 black bold">{{ translate('Total Sales') }}</p>
                                <h3 class="total_sales">{{ $business_stats['total_sales'] }}</h3>
                            </div>
                            <i class="icofont-money font-40 color-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--End total Sales-->

            {{-- Order Summary  --}}

            <!-- Pendig Order -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-list font-20 color-icon"></i>
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Pending') }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <h5 class="pending_orders">
                                    {{ $business_stats['pending_orders'] }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Pending Order -->

            <!-- approved Order -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-tick-boxed font-20 color-icon"></i>
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Approved') }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <h5 class="approved">
                                    {{ $business_stats['approved'] }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End approved Order -->

            <!-- ready_to_ship Order -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-box font-20 color-icon"></i>
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Ready to Ship') }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <h5 class="ready_to_ship">
                                    {{ $business_stats['ready_to_ship'] }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End ready_to_ship Order -->

            <!-- Shipped Order -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-fast-delivery font-20 color-icon"></i>
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Shipped') }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <h5 class="shipped-order">
                                    {{ $business_stats['shipped'] }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End shipped order -->

            <!-- delivered Order -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-tick-mark font-20 color-icon"></i>
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Delivered') }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <h5 class="delivered-order">
                                    {{ $business_stats['delivered'] }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End delivered order -->

            <!-- cancelled order -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-close font-20 color-icon"></i>
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Cancelled') }}</h5>
                                </div>
                            </div>
                            <div class="">
                                <h5 class="cancelled-order">
                                    {{ $business_stats['cancelled'] }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End cancelled order -->

            <!--total_refunds -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-reply font-20 color-icon"></i>
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Returned') }}</h5>
                                </div>
                            </div>
                            <h5 class="total_refunds">
                                {{ $business_stats['total_refunds'] }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End total_refunds -->

            <!-- return_processing -->
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-20 custom-card">
                    <div class="card-body p-2 px-3">
                        <div class="align-items-center  d-flex justify-content-between  order-couter-item">
                            <div class="d-flex align-items-center">
                                <div class="img mr-3">
                                    <i class="icofont-match-review font-20 color-icon"></i>
                                    {{-- <i class="icofont-close font-20 color-icon"></i> --}}
                                </div>
                                <div class="content">
                                    <h5>{{ translate('Refund Processing') }}</h5>
                                </div>
                            </div>
                            <h5 class="return_processing">
                                {{ $business_stats['return_processing'] }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- return_processing -->

            {{-- End Order Summary --}}
        </div>
    </div>
</div>
<!--End Business Stats-->

<div class="row">
    <!--Sales Reports-->
    <div class="col-xl-12 col-12">
        <div class="card mb-30">
            <div
                class="card-header bg-white py-3 d-flex justify-content-start justify-content-sm-between align-items-start align-items-sm-center flex-column flex-sm-row mb-sm-n3  ">
                <div class="title-content mb-4 mr-sm-5 mb-sm-0">
                    <h4 class="">{{ translate('Sale Reports') }}</h4>
                </div>
                <!-- List Button -->
                <ul class="list-inline list-button m-0 mr-5">
                    <li class="active chart-switcher rounded" data-type="monthly">{{ translate('Last 12 Months') }}
                    </li>
                    <li class="chart-switcher rounded" data-type="daily">{{ translate('Last 30 Days') }}</li>
                </ul>
                <!-- End List Button -->
            </div>
            <div class="card-body">
                <div id="apex_sales_report_chart"></div>
            </div>
        </div>
    </div>
    <!--End Sales Reports-->
</div>

<div class="row">
    <!--Recent Orders-->
    <div class="col-xl-8 col-lg-7 col-12">
        <!-- Card -->
        <div class="card fixed-card mb-30">
            <div class="card-header py-3 bg-white">
                <h4>{{ translate('Recent Orders') }}</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="style--three table-centered text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ translate('Order ID') }}</th>
                                <th>{{ translate('Date') }}</th>
                                <th>{{ translate('Customer') }}</th>
                                <th>{{ translate('Total Amount') }}</th>
                                <th>{{ translate('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($recent_orders->count() > 0)
                                @foreach ($recent_orders as $order)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('plugin.ecommerce.orders.details', ['id' => $order->id]) }}">{{ $order->order_code }}</a>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                                        <td>
                                            @if ($order->customer_info != null)
                                                <a
                                                    href="{{ route('plugin.ecommerce.customers.details', ['id' => $order->customer_id]) }}">{{ $order->customer_info->name }}</a>
                                            @else
                                                <a href="#">{{ $order->guest_customer->name }}<span
                                                        class="badge badge-info ml-1">Guest</span></a>
                                            @endif
                                        </td>
                                        <td>{!! currencyExchange($order->total_payable_amount) !!}</td>
                                        <td>
                                            <a href="{{ route('plugin.ecommerce.orders.details', ['id' => $order->id]) }}"
                                                class="details-btn">
                                                Details
                                                <i class="icofont-arrow-right"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <p class="alert alert-danger text-center">{{ translate('Nothing found') }}</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- End Card -->
    </div>
    <!--End recents orders-->

    <!--Top customers-->
    <div class="col-xl-4 col-lg-5">
        <div class="card fixed-card mb-20">
            <div class="card-header bg-white py-3">
                <h4>{{ translate('Top Customers') }}</h4>
            </div>
            <div class="card-body">
                <div class="product-list">
                    @if ($top_customers->count() > 0)
                        @foreach ($top_customers as $customer)
                            <div
                                class="product-list-item mb-20 d-flex justify-content-between align-items-center gap-15">
                                <div class="d-flex align-items-center">
                                    <div class="img mr-3">
                                        <img src="{{ asset(getFilePath($customer->image, true)) }}"
                                            alt="{{ $customer->name }}">
                                    </div>
                                    <div class="content">
                                        <a href="{{ route('plugin.ecommerce.customers.details', ['id' => $customer->id]) }}"
                                            class="black mb-1">{{ $customer->name }}
                                        </a>
                                        <p class="bold font-14">
                                            {!! currencyExchange($customer->orders->sum('total_payable_amount')) !!}</p>
                                    </div>
                                </div>
                                <p class="bold  font-14 text-center">{{ $customer->orders_count }}<br>
                                    {{ $customer->orders_count > 1 ? 'Orders' : 'Order' }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End Top Customers-->
</div>

<div class="row">
    <!--popular Products-->
    <div class="col-xl-4 col-lg-6">
        <div class="card fixed-card mb-30">
            <div class="card-header bg-white py-3">
                <h4>{{ translate('Popular Products') }}</h4>
            </div>
            <div class="card-body">
                <div class="product-list">
                    @if ($popular_products->count() > 0)
                        @foreach ($popular_products as $product)
                            <div
                                class="product-list-item mb-20 d-flex justify-content-between align-items-center gap-15">
                                <div class="d-flex align-items-center">
                                    <div class="img mr-3">
                                        <img src="{{ asset(getFilePath($product->thumbnail_image, true)) }}"
                                            alt="{{ $product->translation('name', getLocale()) }}"
                                            class="dash-image">
                                    </div>
                                    <div class="content">
                                        <p class="black mb-1 overflow-text text-capitalize">
                                            {{ $product->translation('name', getLocale()) }}</p>
                                        {{-- <span class="bold font-14">{{ $product->reviews_avg_rating }}</span> --}}
                                        <div class="product-rating-wrapper">
                                            <i data-star="{{ $product->reviews_avg_rating }}"
                                                title="{{ $product->reviews_avg_rating }}"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="bold  font-14 text-center">
                                    {{ $product->reviews_count != null ? $product->reviews_count : 0 }}<br>
                                    {{ $product->reviews_count > 1 ? 'Reviews' : 'Review' }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End popular Products-->
    <!--Top Selling Products-->
    <div class="col-xl-4 col-lg-6">
        <div class="card fixed-card mb-30">
            <div class="card-header bg-white py-3">
                <h4>{{ translate('Top Selling Products') }}</h4>
            </div>
            <div class="card-body">
                <div class="product-list">
                    @if ($top_selling_products->count() > 0)
                        @foreach ($top_selling_products as $product)
                            <div
                                class="product-list-item mb-20 d-flex justify-content-between align-items-center gap-15">
                                <div class="d-flex align-items-center">
                                    <div class="img mr-3">
                                        <img src="{{ asset(getFilePath($product->thumbnail_image, true)) }}"
                                            alt="{{ $product->translation('name', getLocale()) }}"
                                            class="dash-image">
                                    </div>
                                    <div class="content">
                                        <p class="black mb-1 overflow-text text-capitalize">
                                            {{ $product->translation('name', getLocale()) }}</p>
                                        <span class="bold font-14">{!! currencyExchange($product->orders_sum_unit_price * $product->orders_sum_quantity) !!}</span>
                                    </div>
                                </div>
                                <p class="bold  font-14 text-center">
                                    {{ $product->orders_count != null ? $product->orders_count : 0 }}<br>
                                    {{ $product->orders_count > 1 ? 'Sales' : 'Sale' }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End Top Selling Products-->
    <!--Top selling shop-->
    @if (isActivePlugin('multivendor'))
        <div class="col-xl-4 col-lg-6">
            <div class="card fixed-card mb-30">
                <div class="card-header bg-white py-3">
                    <h4>{{ translate('Top Selling Store') }}</h4>
                </div>
                <div class="card-body">
                    <div class="product-list">
                        @if ($top_selling_stores->count() > 0)
                            @foreach ($top_selling_stores as $shop)
                                <div
                                    class="product-list-item mb-20 d-flex justify-content-between align-items-center gap-15">
                                    <div class="d-flex align-items-center">
                                        <div class="img mr-3">
                                            <img src="{{ asset(getFilePath($shop['logo'], true)) }}"
                                                alt="{{ $shop['shop_name'] }}">
                                        </div>
                                        <div class="content">
                                            <p class="black mb-1">{{ $shop['shop_name'] }}</p>
                                            <span class=" bold font-14">{!! currencyExchange($shop['orders_sum_unit_price']) !!}</span>
                                        </div>
                                    </div>
                                    <p class="bold  font-14 text-center">
                                        {{ $shop['orders_count'] != null ? $shop['orders_count'] : 0 }}<br>
                                        {{ $shop['orders_count'] > 1 ? 'Sales' : 'Sale' }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--End Top selling shop-->

        <!--Popular_stores-->
        <div class="col-xl-4 col-lg-6">
            <div class="card fixed-card mb-30">
                <div class="card-header bg-white py-3">
                    <h4>{{ translate(' Popular Stores') }}</h4>
                </div>
                <div class="card-body">
                    <div class="product-list">
                        @if ($popular_stores->count() > 0)
                            @foreach ($popular_stores as $shop)
                                <div
                                    class="product-list-item mb-20 d-flex justify-content-between align-items-center gap-15">
                                    <div class="d-flex align-items-center">
                                        <div class="img mr-3">
                                            <img src="{{ asset(getFilePath($shop['logo'], true)) }}"
                                                alt="{{ $shop['shop_name'] }}">
                                        </div>
                                        <div class="content">
                                            <p class="black mb-1">{{ $shop['shop_name'] }}</p>
                                        </div>
                                    </div>
                                    <p class="bold  font-14 text-center">
                                        {{ $shop['followers_count'] != null ? $shop['followers_count'] : 0 }}<br>
                                        {{ $shop['followers_count'] > 1 ? 'Followers' : 'Follower' }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--End Popular_stores-->


    <!--Top Categories-->
    <div class="col-xl-4 col-lg-6">
        <div class="card fixed-card mb-30">
            <div class="card-header bg-white py-3">
                <h4>{{ translate('Top Categories') }}</h4>
            </div>
            <div class="card-body">
                <div class="product-list">
                    @if ($top_categories->count() > 0)
                        @foreach ($top_categories as $category)
                            <div
                                class="product-list-item mb-20 d-flex justify-content-between align-items-center gap-15">
                                <div class="d-flex align-items-center">
                                    <div class="img mr-3">
                                        <img src="{{ asset(getFilePath($category['icon'], true)) }}"
                                            alt="{{ $category['name'] }}">
                                    </div>
                                    <div class="content">
                                        <p class="black mb-1">{{ $category['name'] }}</p>
                                        <span class=" bold font-14">{!! currencyExchange($category['total_sales']) !!}</span>
                                    </div>
                                </div>
                                <p class="bold  font-14 text-center">
                                    {{ $category['number_of_sales'] != null ? $category['number_of_sales'] : 0 }}<br>
                                    {{ $category['number_of_sales'] > 1 ? 'Sales' : 'Sale' }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End Top Categories-->
    <!--Top Brands-->
    <div class="col-xl-4 col-lg-6">
        <div class="card fixed-card mb-30">
            <div class="card-header bg-white py-3">
                <h4>{{ translate('Top Brands') }}</h4>
            </div>
            <div class="card-body">
                <div class="product-list">
                    @if ($top_brands->count() > 0)
                        @foreach ($top_brands as $brand)
                            <div
                                class="product-list-item mb-20 d-flex justify-content-between align-items-center gap-15">
                                <div class="d-flex align-items-center">
                                    <div class="img mr-3">
                                        <img src="{{ asset(getFilePath($brand['logo'], true)) }}"
                                            alt="{{ $brand['name'] }}" class="img-20">
                                    </div>
                                    <div class="content">
                                        <p class="black mb-1">{{ $brand['name'] }}</p>
                                        <span class="bold font-14">{!! currencyExchange($brand['total_sales']) !!}</span>
                                    </div>
                                </div>
                                <p class="bold  font-14 text-center">
                                    {{ $brand['number_of_sales'] != null ? $brand['number_of_sales'] : 0 }}<br>
                                    {{ $brand['number_of_sales'] > 1 ? 'Sales' : 'Sale' }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="alert alert-danger text-center">{{ translate('Nothing Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End Top Brands-->
</div>




@push('script')
    <script>
        (function($) {
            "use strict";
            let chart_data_type = "monthly";
            let categories = [];
            //change chart data type
            $(".chart-switcher").on('click', function(e) {
                e.preventDefault();
                $('.chart-switcher').removeClass('active');
                $(this).addClass('active');
                chart_data_type = $(this).data('type');
                getChartData();
            });

            //Change business stat
            $("#business_insight_change").on('change', function(e) {
                let item = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        item: item
                    },
                    url: '{{ route('plugin.ecommerce.business.stats') }}',
                    success: function(response) {
                        if (response.success) {
                            $(".total_customer").html(response.data.total_customers);
                            $(".total_products").html(response.data.total_products);
                            $(".total_orders").html(response.data.total_orders);
                            $(".total_sales").html(response.data.total_sales);

                            $(".pending_orders").html(response.data.pending_orders);
                            $(".approved").html(response.data.approved);
                            $(".ready_to_ship").html(response.data.ready_to_ship);
                            $(".shipped-order").html(response.data.shipped);
                            $(".delivered-order").html(response.data.delivered);
                            $(".cancelled-order").html(response.data.cancelled);
                            $(".total_refunds").html(response.data.total_refunds);
                            $(".return_processing").html(response.data.return_processing);
                        }
                    }
                });
            });

            //Get data from api
            function getChartData() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        type: chart_data_type
                    },
                    url: '{{ route('plugin.ecommerce.reports.sales.chart') }}',
                    success: function(data) {
                        if (data.success) {
                            categories = data.times;
                            sales_chart.updateSeries([{
                                name: 'Sales',
                                data: data.sales
                            }])

                            sales_chart.updateOptions({
                                xaxis: {
                                    categories: data.times
                                }
                            })
                        }
                    }
                });
            }
            //chart options
            var sales_chart_options = {
                series: [],
                chart: {
                    height: 500,
                    type: 'bar',
                    toolbar: {
                        show: true,
                    },
                    zoom: {
                        enabled: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    dashArray: 3
                },
                colors: ['#FFBA5A', '#8381FD'],
                grid: {
                    borderColor: '#f5f5f5',
                },
                markers: {
                    size: 7,
                    colors: ["#67CF94"],
                    hover: {
                        size: 8,
                    }
                },
                xaxis: {
                    categories: [],
                },
                yaxis: {
                    tickAmount: 4,
                    labels: {
                        formatter: function(val, index) {
                            return val.toFixed(2);
                        }
                    }
                },
                responsive: [{
                    breakpoint: 576,
                    options: {
                        markers: {
                            size: 5,
                            colors: ["#67CF94"],
                            hover: {
                                size: 5,
                            }
                        },
                    }
                }],
            };
            //Render chart
            var sales_chart = new ApexCharts(document.querySelector(
                "#apex_sales_report_chart"), sales_chart_options);
            sales_chart.render();

            $(document).ready(function() {
                getChartData();
            });
        })(jQuery);
    </script>
@endpush
