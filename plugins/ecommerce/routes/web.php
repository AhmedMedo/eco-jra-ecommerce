<?php

use Illuminate\Support\Facades\Route;
use Plugin\Ecommerce\Http\Controllers\TaxController;
use Plugin\Ecommerce\Http\Controllers\UnitController;
use Plugin\Ecommerce\Http\Controllers\BrandController;
use Plugin\Ecommerce\Http\Controllers\ColorController;
use Plugin\Ecommerce\Http\Controllers\OrderController;
use Plugin\Ecommerce\Http\Controllers\ReportController;
use Plugin\Ecommerce\Http\Controllers\ProductController;
use Plugin\Ecommerce\Http\Controllers\CategoryController;
use Plugin\Ecommerce\Http\Controllers\CurrencyController;
use Plugin\Ecommerce\Http\Controllers\CustomerController;
use Plugin\Ecommerce\Http\Controllers\LocationController;
use Plugin\Ecommerce\Http\Controllers\SettingsController;
use Plugin\Ecommerce\Http\Controllers\ShippingController;
use \Plugin\Ecommerce\Http\Controllers\MarketingController;
use Plugin\Ecommerce\Http\Controllers\ProductTagsController;
use Plugin\Ecommerce\Http\Controllers\Payment\GpayController;
use Plugin\Ecommerce\Http\Controllers\Payment\MollieController;
use Plugin\Ecommerce\Http\Controllers\Payment\PaddleController;
use Plugin\Ecommerce\Http\Controllers\Payment\PaypalController;
use Plugin\Ecommerce\Http\Controllers\Payment\StripeController;
use Plugin\Ecommerce\Http\Controllers\Payment\PaymentController;
use Plugin\Ecommerce\Http\Controllers\Payment\PaystackController;
use Plugin\Ecommerce\Http\Controllers\Payment\RazorpayController;
use Plugin\Ecommerce\Http\Controllers\ProductAttributeController;
use Plugin\Ecommerce\Http\Controllers\ProductConditionController;
use Plugin\Ecommerce\Http\Controllers\ProductCollectionController;
use Plugin\Ecommerce\Http\Controllers\Payment\SSLCommerzController;

Route::group(['middleware' => 'auth', 'prefix' => getAdminPrefix()], function () {

    //product category module
    Route::middleware(['vhost', 'vhost',  'can:Manage Categories'])->group(function () {
        Route::get('/product-categories', [CategoryController::class, 'categories'])->name('plugin.ecommerce.product.category.list');
        Route::get('/new-category', [CategoryController::class, 'newCategory'])->name('plugin.ecommerce.product.category.new');
        Route::post('/new-category-store', [CategoryController::class, 'newCategoryStore'])->name('plugin.ecommerce.product.category.new.store')->middleware('demo');
        Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('plugin.ecommerce.product.category.edit');
        Route::post('/category-update', [CategoryController::class, 'updateCategory'])->name('plugin.ecommerce.product.category.update')->middleware('demo');
        Route::post('/category-delete', [CategoryController::class, 'deleteCategory'])->name('plugin.ecommerce.product.category.delete')->middleware('demo');
        Route::post('/category-bulk--delete', [CategoryController::class, 'deleteBulkCategory'])->name('plugin.ecommerce.product.category.delete.bulk')->middleware('demo');
        Route::post('/category-change-status', [CategoryController::class, 'categoryChangeStatus'])->name('plugin.ecommerce.product.category.status.change')->middleware('demo');
        Route::post('/category-change-featured-status', [CategoryController::class, 'changeCategoryFeaturedStatus'])->name('plugin.ecommerce.product.category.featured.change')->middleware('demo');
    });

    //Product brand module
    Route::middleware(['vhost',  'vhost',  'can:Manage Brands'])->group(function () {
        Route::get('/product-brands', [BrandController::class, 'productBrands'])->name('plugin.ecommerce.product.brand.list');
        Route::view('/new-product-brand', 'plugin/ecommerce::products.brands.new_brand')->name('plugin.ecommerce.product.brand.new');
        Route::post('/store-new-product-brand', [BrandController::class, 'storeNewProductBrand'])->name('plugin.ecommerce.product.brand.store')->middleware('demo');
        Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('plugin.ecommerce.product.brand.edit');
        Route::post('/update-product-brand', [BrandController::class, 'updateProductBrand'])->name('plugin.ecommerce.product.brand.update')->middleware('demo');
        Route::post('/delete-product-brand', [BrandController::class, 'deleteProductBrand'])->name('plugin.ecommerce.product.brand.delete')->middleware('demo');
        Route::post('/delete-bulk-product-brand', [BrandController::class, 'deleteBulkProductBrand'])->name('plugin.ecommerce.product.brand.delete.bulk')->middleware('demo');
        Route::post('/change-product-brand-status', [BrandController::class, 'changeProductBrandStatus'])->name('plugin.ecommerce.product.brand.status.change')->middleware('demo');
        Route::post('/change-product-brand-featured-status', [BrandController::class, 'changeProductBrandFeatured'])->name('plugin.ecommerce.product.brand.featured.status.change')->middleware('demo');
    });

    //color module
    Route::middleware(['vhost',  'can:Manage Colors'])->group(function () {
        Route::view('/new-product-color', 'plugin/ecommerce::products.colors.create_new')->name('plugin.ecommerce.product.colors.new');
        Route::get('/product-colors', [ColorController::class, 'colors'])->name('plugin.ecommerce.product.colors.list');
        Route::post('/store-new-product-colors', [ColorController::class, 'storeColor'])->name('plugin.ecommerce.product.colors.store')->middleware('demo');
        Route::post('/delete-product-color', [ColorController::class, 'deleteColor'])->name('plugin.ecommerce.product.colors.delete')->middleware('demo');
        Route::get('/product-color-edit/{id}', [ColorController::class, 'editColor'])->name('plugin.ecommerce.product.colors.edit');
        Route::post('/update-product-color', [ColorController::class, 'updateColor'])->name('plugin.ecommerce.product.colors.update')->middleware('demo');
        Route::post('/delete-bulk-product-color', [ColorController::class, 'deleteBulkColor'])->name('plugin.ecommerce.product.colors.delete.bulk')->middleware('demo');
    });

    //product unit module
    Route::middleware(['vhost',  'vhost',  'can:Manage Units'])->group(function () {
        Route::get('/product-units', [UnitController::class, 'units'])->name('plugin.ecommerce.product.units.list');
        Route::view('/new-product-unit', 'plugin/ecommerce::products.units.add_new')->name('plugin.ecommerce.product.units.new');
        Route::post('/product-unit-store', [UnitController::class, 'storeUnit'])->name('plugin.ecommerce.product.units.store')->middleware('demo');
        Route::post('/product-unit-delete', [UnitController::class, 'deleteUnit'])->name('plugin.ecommerce.product.units.delete')->middleware('demo');
        Route::post('/product-unit-bulk-delete', [UnitController::class, 'deleteBulkUnit'])->name('plugin.ecommerce.product.units.delete.bulk')->middleware('demo');
        Route::get('/edit-product-unit/{id}', [UnitController::class, 'editUnit'])->name('plugin.ecommerce.product.units.edit');
        Route::post('/product-unit-update', [UnitController::class, 'updateUnit'])->name('plugin.ecommerce.product.units.update')->middleware('demo');
    });

    //product condition
    Route::middleware(['vhost',  'vhost',  'can:Manage Product Conditions'])->group(function () {
        Route::get('/product-conditions', [ProductConditionController::class, 'conditions'])->name('plugin.ecommerce.product.conditions.list');
        Route::view('/new-product-condition', 'plugin/ecommerce::products.conditions.new_condition')->name('plugin.ecommerce.product.conditions.new');
        Route::post('/store-product-condition', [ProductConditionController::class, 'storeCondition'])->name('plugin.ecommerce.product.conditions.store')->middleware('demo');
        Route::post('/change-product-condition-status', [ProductConditionController::class, 'changeConditionStatus'])->name('plugin.ecommerce.product.conditions.status.change')->middleware('demo');
        Route::post('/product-condition-delete', [ProductConditionController::class, 'deleteCondition'])->name('plugin.ecommerce.product.conditions.delete')->middleware('demo');
        Route::post('/product-condition-bulk-delete', [ProductConditionController::class, 'deleteBulkCondition'])->name('plugin.ecommerce.product.conditions.delete.bulk')->middleware('demo');
        Route::get('/product-condition-edit/{id}', [ProductConditionController::class, 'editCondition'])->name('plugin.ecommerce.product.conditions.edit');
        Route::post('/product-condition-update', [ProductConditionController::class, 'updateCondition'])->name('plugin.ecommerce.product.conditions.update')->middleware('demo');
    });

    //Product tags module
    Route::middleware(['vhost',  'vhost',  'can:Manage Product Tags'])->group(function () {
        Route::get('/product-tags', [ProductTagsController::class, 'productTags'])->name('plugin.ecommerce.product.tags.list');
        Route::view('/add-new-tag', 'plugin/ecommerce::products.tags.create_new')->name('plugin.ecommerce.product.tags.add.new');
        Route::post('/store-new-product-tag', [ProductTagsController::class, 'storeTag'])->name('plugin.ecommerce.product.tags.store')->middleware('demo');
        Route::post('/delete-product-tag', [ProductTagsController::class, 'deleteTag'])->name('plugin.ecommerce.product.tags.delete')->middleware('demo');
        Route::post('/delete-bulk-product-tag', [ProductTagsController::class, 'deleteBulkTag'])->name('plugin.ecommerce.product.tags.delete.bulk')->middleware('demo');
        Route::post('/change-status-product-tag', [ProductTagsController::class, 'changeStatus'])->name('plugin.ecommerce.product.tags.status.change')->middleware('demo');
        Route::get('/edit-product-tag/{id}', [ProductTagsController::class, 'editTag'])->name('plugin.ecommerce.product.tags.edit');
        Route::post('/update-product-tag', [ProductTagsController::class, 'updateTag'])->name('plugin.ecommerce.product.tags.update')->middleware('demo');
    });


    //Product Attribute module
    Route::middleware(['vhost',  'vhost',  'can:Manage Attributes'])->group(function () {
        Route::get('/product-attributes', [ProductAttributeController::class, 'productAttributes'])->name('plugin.ecommerce.product.attributes.list');
        Route::view('/add-new-product-attribute', 'plugin/ecommerce::products.attributes.new_attribute')->name('plugin.ecommerce.product.attributes.add');
        Route::post('/store-product-attribute', [ProductAttributeController::class, 'storeAttribute'])->name('plugin.ecommerce.product.attributes.store')->middleware('demo');
        Route::get('/edit-product-attribute/{id}', [ProductAttributeController::class, 'editAttribute'])->name('plugin.ecommerce.product.attributes.edit');
        Route::post('/update-product-attribute', [ProductAttributeController::class, 'updateAttribute'])->name('plugin.ecommerce.product.attributes.update')->middleware('demo');
        Route::post('/delete-product-attribute', [ProductAttributeController::class, 'deleteAttribute'])->name('plugin.ecommerce.product.attributes.delete')->middleware('demo');
        Route::post('/delete-bulk-product-attribute', [ProductAttributeController::class, 'deleteBulkAttribute'])->name('plugin.ecommerce.product.attributes.delete.bulk')->middleware('demo');
        Route::get('/product-attribute-values/{id}', [ProductAttributeController::class, 'attributeValues'])->name('plugin.ecommerce.product.attributes.values');
        Route::post('/product-attribute-values-store', [ProductAttributeController::class, 'attributeValuesStore'])->name('plugin.ecommerce.product.attributes.values.store')->middleware('demo');
        Route::post('/product-attribute-values-delete', [ProductAttributeController::class, 'attributeValueDelete'])->name('plugin.ecommerce.product.attributes.values.delete')->middleware('demo');
        Route::get('/product-attribute-value-edit/{id}', [ProductAttributeController::class, 'attributeValueEdit'])->name('plugin.ecommerce.product.attributes.values.edit');
        Route::post('/product-attribute-value-update', [ProductAttributeController::class, 'attributeValueUpdate'])->name('plugin.ecommerce.product.attributes.values.update')->middleware('demo');
        Route::post('/product-attribute-status-change', [ProductAttributeController::class, 'attributeStatusChange'])->name('plugin.ecommerce.product.attributes.status.change')->middleware('demo');
        Route::post('/product-attribute-value-status-change', [ProductAttributeController::class, 'attributeValueStatusChange'])->name('plugin.ecommerce.product.attributes.value.status.change')->middleware('demo');
    });

    //Product list
    Route::get('/product-dropdown-options', [ProductController::class, 'productDropdownOptions'])->name('plugin.ecommerce.product.dropdown.options');
    Route::middleware(['vhost',  'vhost',  'can:Manage Inhouse Products'])->group(function () {
        Route::get('/products', [ProductController::class, 'productList'])->name('plugin.ecommerce.product.list');
        Route::post('/product-bulk-action', [ProductController::class, 'productBulkAction'])->name('plugin.ecommerce.product.bulk.action');
        Route::post('/update-product-status', [ProductController::class, 'updateProductStatus'])->name('plugin.ecommerce.product.status.update')->middleware('demo');
        Route::post('/update-product-approval-status', [ProductController::class, 'updateProductApprovalStatus'])->name('plugin.ecommerce.product.approval.status.update')->middleware('demo');
        Route::post('/update-product-featured-status', [ProductController::class, 'updateProductFeaturedStatus'])->name('plugin.ecommerce.product.status.featured.update')->middleware('demo');
        Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('plugin.ecommerce.product.delete');
        Route::post('/view-product-quick-action-modal', [ProductController::class, 'viewProductQuickActionForm'])->name('plugin.ecommerce.product.quick.action.modal.view');
        Route::post('/product-quick-discount-update', [ProductController::class, 'updateProductDiscount'])->name('plugin.ecommerce.product.quick.update.discount')->middleware('demo');
        Route::post('/product-quick-price-update', [ProductController::class, 'updateProductPrice'])->name('plugin.ecommerce.product.quick.update.price')->middleware('demo');
        Route::post('/product-quick-stock-update', [ProductController::class, 'updateProductStock'])->name('plugin.ecommerce.product.quick.update.stock')->middleware('demo');
    });

    //Product reviews
    Route::middleware(['vhost',  'vhost',  'can:Manage Product Reviews'])->group(function () {
        Route::get('/product-reviews', [ProductController::class, 'productReviewsList'])->name('plugin.ecommerce.product.reviews.list');
        Route::post('/update-product-review-status', [ProductController::class, 'updateProductReviewStatus'])->name('plugin.ecommerce.product.reviews.status.change')->middleware('demo');
        Route::post('/product-review-delete', [ProductController::class, 'productReviewelete'])->name('plugin.ecommerce.product.reviews.delete')->middleware('demo');
    });

    //product form
    Route::get('/product-categories-options', [ProductController::class, 'productCategoryOption'])->name('plugin.ecommerce.product.category.option');
    Route::get('/product-brands-options', [ProductController::class, 'productBrandsOption'])->name('plugin.ecommerce.product.brand.option');
    Route::get('/product-tags-options', [ProductController::class, 'productTagsOption'])->name('plugin.ecommerce.product.tag.option');
    Route::get('/product-cod-countries-dropdown-options', [ProductController::class, 'codCountriesDropdownOptions'])->name('plugin.ecommerce.product.cod.countries.dropdown.option');
    Route::get('/product-cod-states-dropdown-options', [ProductController::class, 'codStateDropdownOptions'])->name('plugin.ecommerce.product.cod.state.dropdown.option');
    Route::get('/product-cod-cities-dropdown-options', [ProductController::class, 'codCityDropdownOptions'])->name('plugin.ecommerce.product.cod.city.dropdown.option');


    Route::middleware(['vhost',  'vhost',  'can:Manage Add New Product'])->group(function () {
        Route::get('/add-new-product', [ProductController::class, 'addNewProduct'])->name('plugin.ecommerce.product.add.new');
        Route::post('/store-new-product', [ProductController::class, 'storeNewProduct'])->name('plugin.ecommerce.product.store.new')->middleware('demo');
    });

    Route::middleware(['vhost',  'vhost',  'can:Manage Inhouse Products'])->group(function () {
        Route::get('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('plugin.ecommerce.product.edit');
        Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('plugin.ecommerce.product.update')->middleware('demo');
    });

    Route::post('/add-product-choice-option', [ProductController::class, 'addProductChoiceOption'])->name('plugin.ecommerce.product.form.add.choice.option');
    Route::post('/generate-product-variant-combination', [ProductController::class, 'variantCombination'])->name('plugin.ecommerce.product.form.variant.combination');
    Route::post('/load-color-variant-image-input', [ProductController::class, 'colorVariantImageInput'])->name('plugin.ecommerce.product.form.color.variant.image.input');

    /**
     * 
     * Product collections
     */
    Route::middleware(['vhost',  'vhost',  'can:Manage Product collections'])->group(function () {
        Route::get('/product-collections', [ProductCollectionController::class, 'collections'])->name('plugin.ecommerce.product.collection.list');
        Route::get('/add-new-product-collection', [ProductCollectionController::class, 'newCollection'])->name('plugin.ecommerce.product.collection.add.new');
        Route::post('/store-new-product-collection', [ProductCollectionController::class, 'storeNewCollection'])->name('plugin.ecommerce.product.collection.store.new')->middleware('demo');
        Route::get('/edit-product-collection/{id}', [ProductCollectionController::class, 'editCollection'])->name('plugin.ecommerce.product.collection.edit');
        Route::post('/update-product-collection', [ProductCollectionController::class, 'updateCollection'])->name('plugin.ecommerce.product.collection.update')->middleware('demo');
        Route::post('/delete-product-collection', [ProductCollectionController::class, 'deleteCollection'])->name('plugin.ecommerce.product.collection.delete')->middleware('demo');
        Route::post('/update-product-collection-status', [ProductCollectionController::class, 'updateCollectionStatus'])->name('plugin.ecommerce.product.collection.update.status')->middleware('demo');
        Route::post('/bulk-delete-product-collection', [ProductCollectionController::class, 'deleteBulkCollection'])->name('plugin.ecommerce.product.collection.delete.bulk')->middleware('demo');
        Route::get('/collection-products/{id}', [ProductCollectionController::class, 'collectionProducts'])->name('plugin.ecommerce.product.collection.products');
        Route::post('/store-collection-products', [ProductCollectionController::class, 'storeCollectionProducts'])->name('plugin.ecommerce.product.collection.products.store')->middleware('demo');
        Route::post('/remove-collection-product', [ProductCollectionController::class, 'removeCollectionProduct'])->name('plugin.ecommerce.product.collection.products.remove')->middleware('demo');
        Route::post('/bulk-remove-collection-product', [ProductCollectionController::class, 'removeBulkCollectionProduct'])->name('plugin.ecommerce.product.collection.products.remove.bulk')->middleware('demo');
    });

    /**
     * Shipping modules routes
     */
    Route::group(['prefix' => 'shipping'], function () {
        Route::middleware(['vhost',  'vhost',  'can:Manage Shipping & Delivery'])->group(function () {
            //shipping and delivery
            Route::get('/configuration', [ShippingController::class, 'shippingAndDelivery'])->name('plugin.ecommerce.shipping.configuration');
            Route::post('/update-shipping-option', [ShippingController::class, 'updateShippingOption'])->name('plugin.ecommerce.shipping.option.update')->middleware('demo');
            Route::post('/update-flat-rate-shipping', [ShippingController::class, 'updateFlatRateShipping'])->name('plugin.ecommerce.shipping.flat.rate.update')->middleware('demo');
            //Shipping time 
            Route::post('/store-new-shipping-time', [ShippingController::class, 'storeShippingTime'])->name('plugin.ecommerce.shipping.time.store')->middleware('demo');
            Route::post('/delete-shipping-time', [ShippingController::class, 'deleteShippingTime'])->name('plugin.ecommerce.shipping.time.delete')->middleware('demo');

            //Shipping Profiles
            Route::get('/create-shipping-profile', [ShippingController::class, 'shippingProfileForm'])->name('plugin.ecommerce.shipping.profile.form');
            Route::post('/store-shipping-profile', [ShippingController::class, 'storeShippingProfile'])->name('plugin.ecommerce.shipping.profile.store')->middleware('demo');
            Route::get('/manage-shipping-profile/{id}', [ShippingController::class, 'manageShippingProfile'])->name('plugin.ecommerce.shipping.profile.manage');
            Route::post('/update-shipping-profile', [ShippingController::class, 'updateShippingProfile'])->name('plugin.ecommerce.shipping.profile.update')->middleware('demo');
            Route::post('/update-shipping-product-list', [ShippingController::class, 'updateShippingProductList'])->name('plugin.ecommerce.shipping.profile.update.product.list')->middleware('demo');
            Route::post('/remove-product-from-profile', [ShippingController::class, 'removeProduct'])->name('plugin.ecommerce.shipping.profile.product.remove')->middleware('demo');
            Route::post('/delete-shipping-profile', [ShippingController::class, 'deleteShippingProfile'])->name('plugin.ecommerce.shipping.profile.delete')->middleware('demo');

            //Shipping Zones
            Route::post('/locations-ul-list', [ShippingController::class, 'locationUlList'])->name('plugin.ecommerce.shipping.location.ul.list');
            Route::post('/locations-ul-list-edit', [ShippingController::class, 'locationUlListEdt'])->name('plugin.ecommerce.shipping.location.ul.list.edit');
            Route::post('/search-locations-ul-list', [ShippingController::class, 'searchLocationUlList'])->name('plugin.ecommerce.shipping.search.location.ul.list');
            Route::post('/search-locations-ul-list-edit', [ShippingController::class, 'searchLocationUlListEdit'])->name('plugin.ecommerce.shipping.search.location.ul.list.edit');
            Route::post('/locations-searched-ul-list', [ShippingController::class, 'locationSearchedUlList'])->name('plugin.ecommerce.shipping.location.searched.list');
            Route::post('/store-shipping-new-zone', [ShippingController::class, 'storeNewShippingZone'])->name('plugin.ecommerce.shipping.profile.zones.store')->middleware('demo');
            Route::post('/edit-shipping-zone', [ShippingController::class, 'editShippingZone'])->name('plugin.ecommerce.shipping.profile.zones.edit');
            Route::post('/update-shipping-zone', [ShippingController::class, 'updateShippingZone'])->name('plugin.ecommerce.shipping.profile.zones.update')->middleware('demo');
            Route::post('/delete-shipping-zone', [ShippingController::class, 'deleteZone'])->name('plugin.ecommerce.shipping.zones.delete')->middleware('demo');
            //Shipping Rates
            Route::post('/store-shipping-rate', [ShippingController::class, 'storeShippingRate'])->name('plugin.ecommerce.shipping.store.rate')->middleware('demo');
            Route::post('/edit-shipping-rate', [ShippingController::class, 'editShippingRate'])->name('plugin.ecommerce.shipping.rate.edit');
            Route::post('/update-shipping-rate', [ShippingController::class, 'updateShippingRate'])->name('plugin.ecommerce.shipping.rate.update')->middleware('demo');
            Route::post('/delete-shipping-rate', [ShippingController::class, 'deleteShippingRate'])->name('plugin.ecommerce.shipping.delete.rate')->middleware('demo');
            Route::get('/load-carrier-shipping-weight-range', function () {
                return view('plugin/ecommerce::shipping.configuration.carrier-shipping-weight-range');
            })->name('plugin.ecommerce.shipping.carrier.weight.range.input');
        });



        Route::middleware(['vhost',  'vhost',  'can:Manage Locations'])->group(function () {
            //countries module
            Route::get('/countries', [LocationController::class, 'countries'])->name('plugin.ecommerce.shipping.locations.country.list');
            Route::get('/new-country', [LocationController::class, 'newCountry'])->name('plugin.ecommerce.shipping.locations.country.new');
            Route::post('/store-new-country', [LocationController::class, 'storeNewCountry'])->name('plugin.ecommerce.shipping.locations.country.new.store')->middleware('demo');
            Route::post('/delete-country', [LocationController::class, 'deleteCountry'])->name('plugin.ecommerce.shipping.locations.country.delete')->middleware('demo');
            Route::post('/country-status-change', [LocationController::class, 'countryStatusChange'])->name('plugin.ecommerce.shipping.locations.country.status.change')->middleware('demo');
            Route::get('/edit-country/{id}', [LocationController::class, 'editCountry'])->name('plugin.ecommerce.shipping.locations.country.edit');
            Route::post('/update-country', [LocationController::class, 'updateCountry'])->name('plugin.ecommerce.shipping.locations.country.update')->middleware('demo');
            Route::post('/country-bulk-actions', [LocationController::class, 'countryBulkActions'])->name('plugin.ecommerce.shipping.locations.country.bulk.action')->middleware('demo');

            //states
            Route::get('/states', [LocationController::class, 'states'])->name('plugin.ecommerce.shipping.locations.states.list');
            Route::get('/add-new-state', [LocationController::class, 'newState'])->name('plugin.ecommerce.shipping.locations.states.new.add');
            Route::post('/add-new-state', [LocationController::class, 'storeState'])->name('plugin.ecommerce.shipping.locations.states.new.store')->middleware('demo');
            Route::post('/delete-state', [LocationController::class, 'deleteState'])->name('plugin.ecommerce.shipping.locations.states.delete')->middleware('demo');
            Route::post('/change-state-status', [LocationController::class, 'changeStateStatus'])->name('plugin.ecommerce.shipping.locations.states.status.change')->middleware('demo');
            Route::get('/edit-state/{id}', [LocationController::class, 'editState'])->name('plugin.ecommerce.shipping.locations.states.edit');
            Route::post('/update-state', [LocationController::class, 'updateState'])->name('plugin.ecommerce.shipping.locations.states.update')->middleware('demo');
            Route::post('/state-bulk-actions', [LocationController::class, 'stateBulkActions'])->name('plugin.ecommerce.shipping.locations.states.bulk.action')->middleware('demo');

            //cities
            Route::get('/cities', [LocationController::class, 'cities'])->name('plugin.ecommerce.shipping.locations.cities.list');
            Route::get('/add-new-city', [LocationController::class, 'newCity'])->name('plugin.ecommerce.shipping.locations.cities.add.new');
            Route::post('/store-new-city', [LocationController::class, 'storeNewCity'])->name('plugin.ecommerce.shipping.locations.cities.store.new')->middleware('demo');
            Route::post('/delete-city', [LocationController::class, 'deleteCity'])->name('plugin.ecommerce.shipping.locations.cities.delete')->middleware('demo');
            Route::post('/change-city-status', [LocationController::class, 'changeCityStatus'])->name('plugin.ecommerce.shipping.locations.cities.status.change')->middleware('demo');
            Route::get('/edit-city/{id}', [LocationController::class, 'editCity'])->name('plugin.ecommerce.shipping.locations.cities.edit');
            Route::post('/update-city', [LocationController::class, 'updateCity'])->name('plugin.ecommerce.shipping.locations.cities.update')->middleware('demo');
            Route::post('/cities-bulk-actions', [LocationController::class, 'cityBulkActions'])->name('plugin.ecommerce.shipping.locations.cities.bulk.action')->middleware('demo');
        });
    });
    /**
     * E commerce settings Module
     */
    Route::group(['prefix' => 'ecommerce-settings'], function () {
        //taxes
        Route::middleware(['vhost',  'vhost',  'can:Manage Taxes'])->group(function () {
            Route::get('/taxes', [TaxController::class, 'taxes'])->name('plugin.ecommerce.ecommerce.settings.taxes.list');
            Route::post('/store-tax-profile', [TaxController::class, 'storeTaxProfile'])->name('plugin.ecommerce.ecommerce.settings.taxes.store.profile')->middleware('demo');
            Route::post('/update-tax-profile', [TaxController::class, 'updateTaxProfile'])->name('plugin.ecommerce.ecommerce.settings.taxes.update.profile')->middleware('demo');
            Route::post('/delete-tax-profile', [TaxController::class, 'deleteTaxProfile'])->name('plugin.ecommerce.ecommerce.settings.taxes.delete.profile')->middleware('demo');
            Route::get('/manage-tax-rate/{id}', [TaxController::class, 'manageTaxRates'])->name('plugin.ecommerce.ecommerce.settings.taxes.manage.rates');
            Route::post('/store-new-tax-rates', [TaxController::class, 'storeTaxRates'])->name('plugin.ecommerce.ecommerce.settings.taxes.store.rates')->middleware('demo');
            Route::post('/update-tax-rate-value', [TaxController::class, 'updateTaxRateValue'])->name('plugin.ecommerce.ecommerce.settings.taxes.update.rates.value');
            Route::post('/update-tax-rate-post-code', [TaxController::class, 'updateTaxRatePostCode'])->name('plugin.ecommerce.ecommerce.settings.taxes.update.rates.post.code');
            Route::post('/update-tax-rate-name', [TaxController::class, 'updateTaxRateName'])->name('plugin.ecommerce.ecommerce.settings.taxes.update.rates.name');
            Route::post('/bulk-action-tax-rate', [TaxController::class, 'taxRateBulkAction'])->name('plugin.ecommerce.ecommerce.settings.taxes.rates.bulk.action')->middleware('demo');
        });

        //Product share option
        Route::middleware(['vhost',  'vhost',  'can:Manage Product Share Options'])->group(function () {
            Route::get('/product-share-options', [ProductController::class, 'shareOptions'])->name('plugin.ecommerce.products.share.options');
            Route::post('/product-share-option-update-status', [ProductController::class, 'shareOptionUpdateStatus'])->name('plugin.ecommerce.products.share.options.update.status')->middleware('demo');
        });

        //e-Commerce settings
        Route::middleware(['vhost',  'vhost',  'can:Manage Settings'])->group(function () {
            Route::get('/config', [SettingsController::class, 'ecommerceConfig'])->name('plugin.ecommerce.ecommerce.configuration');
            Route::post('/update-ecommerce-settings', [SettingsController::class, 'updateEcommerceSettings'])->name('plugin.ecommerce.ecommerce.configuration.update')->middleware('demo');
        });

        //Currency Settings
        Route::middleware(['vhost',  'vhost',  'can:Manage Currencies'])->group(function () {
            Route::get('/add-currency', [CurrencyController::class, 'addCurrency'])->name('plugin.ecommerce.ecommerce.add.currency');
            Route::post('/add-currency', [CurrencyController::class, 'storeCurrency'])->name('plugin.ecommerce.ecommerce.store.currency')->middleware('demo');
            Route::get('/all-currencies', [CurrencyController::class, 'allCurrencies'])->name('plugin.ecommerce.ecommerce.all.currencies');
            Route::post('/update-currency-status', [CurrencyController::class, 'updateCurrencyStatus'])->name('plugin.ecommerce.ecommerce.update.currency.status')->middleware('demo');
            Route::get('/edit-currency/{id}', [CurrencyController::class, 'editCurrency'])->name('plugin.ecommerce.ecommerce.edit.currency');
            Route::post('/update-currency', [CurrencyController::class, 'updateCurrency'])->name('plugin.ecommerce.ecommerce.update.currency')->middleware('demo');
            Route::post('/delete-currency', [CurrencyController::class, 'deleteCurrency'])->name('plugin.ecommerce.ecommerce.currency.delete')->middleware('demo');
        });
    });
    /**
     * Orders Module
     */
    Route::group(['prefix' => 'orders'], function () {
        Route::middleware(['vhost',  'vhost',  'can:Manage Inhouse Orders'])->group(function () {
            Route::get('/inhouse-orders', [OrderController::class, 'inhouseOrders'])->name('plugin.ecommerce.orders.inhouse');
        });
        Route::post('/order-status-details', [OrderController::class, 'orderStatusDetails'])->name('plugin.ecommerce.orders.status.details');
        Route::get('/order-details/{id}', [OrderController::class, 'orderDetails'])->name('plugin.ecommerce.orders.details')->middleware(['vhost',  'vhost',  'can:Manage Order Details']);
        Route::post('/accept-order', [OrderController::class, 'acceptOrder'])->name('plugin.ecommerce.orders.accept')->middleware('demo');
        Route::post('/update-order-status', [OrderController::class, 'updateOrderStatus'])->name('plugin.ecommerce.orders.status.update')->middleware('demo');
        Route::post('/cancel-order', [OrderController::class, 'cancelOrder'])->name('plugin.ecommerce.orders.cancel')->middleware('demo');
        Route::post('/cancel-order-item', [OrderController::class, 'cancelOrderItem'])->name('plugin.ecommerce.orders.item.cancel')->middleware('demo');
        Route::post('/order-bulk-action', [OrderController::class, 'orderBulkAction'])->name('plugin.ecommerce.orders.bulk.action')->middleware('demo');
        Route::post('/print-shipping-label', [OrderController::class, 'printShippingLabel'])->name('plugin.ecommerce.orders.print.shipping.label');
        Route::post('/print-order-invoice', [OrderController::class, 'printInvoice'])->name('plugin.ecommerce.orders.print.invoice');
    });
    /**
     *Payments Module
     */
    Route::group(['prefix' => 'payments'], function () {
        Route::middleware(['vhost',  'vhost',  'can:Manage Payment Methods'])->group(function () {
            Route::get('/payment-methods', [PaymentController::class, 'paymentMethods'])->name('plugin.ecommerce.payments.methods')->middleware('license');
            Route::post('/change-payment-method-status', [PaymentController::class, 'changePaymentMethodStatus'])->name('plugin.ecommerce.payments.methods.status.update')->middleware('demo');
            Route::post('/update-payment-method-credential', [PaymentController::class, 'updatePaymentMethodCredential'])->name('plugin.ecommerce.payments.methods.credential.update')->middleware('demo');
        });
        Route::middleware(['vhost',  'vhost',  'can:Manage Transaction history'])->group(function () {
            Route::get('/transaction-history', [PaymentController::class, 'transactionHistory'])->name('plugin.ecommerce.payments.transactions.history');
        });
    });

    /**
     *customers Module
     */
    Route::middleware(['vhost',  'vhost',  'can:Manage Customers'])->group(function () {
        Route::get('/customers', [CustomerController::class, 'customers'])->name('plugin.ecommerce.customers.list');
        Route::post('/change-customer-status', [CustomerController::class, 'changeCustomerStatus'])->name('plugin.ecommerce.customers.change.status')->middleware('demo');
        Route::get('customer-details/{id}', [CustomerController::class, 'customerDetails'])->name('plugin.ecommerce.customers.details');
        Route::post('/reset-customer-password', [CustomerController::class, 'resetCustomerPassword'])->name('plugin.ecommerce.customers.password.reset')->middleware('demo');
        Route::post('/update-customer-info', [CustomerController::class, 'updateCustomerInfo'])->name('plugin.ecommerce.customers.info.update')->middleware('demo');
        Route::post('/customer-secret-login', [CustomerController::class, 'customerSecretLogin'])->name('plugin.ecommerce.customers.login.secret')->middleware('demo');
        Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer'])->name('plugin.ecommerce.customers.delete')->middleware('demo');
    });

    /**
     * Reports Routes
     */
    Route::middleware(['vhost',  'vhost',  'can:Manage Product Reports'])->group(function () {
        Route::get('/products-report', [ReportController::class, 'productReport'])->name('plugin.ecommerce.reports.products');
    });

    Route::middleware(['vhost',  'vhost',  'can:Manage Wishlist Reports'])->group(function () {
        Route::get('/products-wishlist-report', [ReportController::class, 'productWishlistReport'])->name('plugin.ecommerce.reports.products.wishlist');
    });

    Route::middleware(['vhost',  'vhost',  'can:Manage Keyword Search Reports'])->group(function () {
        Route::get('/user-keyword-search', [ReportController::class, 'userKeywordSearch'])->name('plugin.ecommerce.reports.search.keyword');
    });

    Route::post('/sales-chart-report', [ReportController::class, 'salesChartReport'])->name('plugin.ecommerce.reports.sales.chart');

    //Dashboard stats
    Route::post('/business-stats-analysis', [ReportController::class, 'businessStatsAnalysis'])->name('plugin.ecommerce.business.stats');

    /**
     * Marketing Modules
     */
    Route::middleware(['vhost',  'can:Manage Custom notification', "license"])->group(function () {
        Route::get('/custom-notifications', [MarketingController::class, 'customNotifications'])->name('plugin.ecommerce.marketing.custom.notification');
        Route::get('/create-new-custom-notifications', [MarketingController::class, 'newCustomNotifications'])->name('plugin.ecommerce.marketing.custom.notification.create.new');
        Route::get('/get-customer-options', [MarketingController::class, 'getCustomerOptions'])->name('plugin.ecommerce.marketing.custom.notification.customer.options');
        Route::get('/get-users-options', [MarketingController::class, 'getUsersOptions'])->name('plugin.ecommerce.marketing.custom.notification.users.options');
        Route::get('/get-user-roles-options', [MarketingController::class, 'getUserRolesOptions'])->name('plugin.ecommerce.marketing.custom.notification.user.roles.options');
        Route::post('/send-custom-notification', [MarketingController::class, 'sendCustomNotification'])->name('plugin.ecommerce.marketing.custom.notification.send')->middleware('demo');
        Route::post('/custom-notification-bulk-action', [MarketingController::class, 'customNotificationBulkAction'])->name('plugin.ecommerce.marketing.custom.notification.bulk.action');
    });
});

/**
 * Product review details
 */
Route::post(getAdminPrefix() . '/product-review-details', [ProductController::class, 'productReviewDetails'])->name('plugin.ecommerce.product.reviews.details');

/**
 * Payment page
 */
Route::get('/payment/{id}/pay', [PaymentController::class, 'createPayment']);

/**
 * Stripe payment 
 */
Route::any('/stripe/create-session', [StripeController::class, 'create_checkout_session'])->name('stripe.generate.token');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success.payment');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel.payment');

/**
 * Paypal payment
 */
Route::get('/paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

/**
 * paddle payment
 */
Route::any('/paddle/success', [PaddleController::class, 'paddleSuccess'])->name('paddle.payment.success');
Route::any('/paddle/return', [PaddleController::class, 'paddleReturn'])->name('paddle.payment.return');

/**
 * SSLCommerz payment 
 */
Route::any('/ssl-commerce/success', [SSLCommerzController::class, 'success'])->name('sslcommerz.success.payment');
Route::any('/ssl-commerce/cancel', [SSLCommerzController::class, 'cancel'])->name('sslcommerz.cancel.payment');
Route::any('/ssl-commerce/fail', [SSLCommerzController::class, 'fail'])->name('sslcommerz.fail.payment');

//Paystack
Route::get('/pay/callback', [PaystackController::class, 'callback'])->name('pay.callback');

//Razorpay
Route::post('/razorpay-payment-submit', [RazorpayController::class, 'paymentStatus'])->name('razorpay.payment.submit');

//Mollie
Route::get('/payment-callback', [MollieController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/payment-webhook', [MollieController::class, 'paymentWebhook'])->name('payment.webhook');

//Google pay
Route::post('/googlepay-payment-submit', [GpayController::class, 'googlepayPaymentSubmit'])->name('googlepay.payment.submit');
