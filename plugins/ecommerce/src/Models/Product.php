<?php

namespace Plugin\Ecommerce\Models;

use Core\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Plugin\Ecommerce\Models\Units;
use Plugin\Ecommerce\Models\Cities;
use Plugin\Ecommerce\Models\States;
use Plugin\Ecommerce\Models\Country;
use Plugin\Ecommerce\Models\ProductSeo;
use Plugin\Ecommerce\Models\ProductTags;
use Plugin\Ecommerce\Models\ProductReview;
use Plugin\Ecommerce\Models\ProductHasTags;
use Plugin\Ecommerce\Models\ProductCodState;
use Plugin\Ecommerce\Models\OrderHasProducts;
use Plugin\Ecommerce\Models\ProductCodCities;
use Plugin\Ecommerce\Models\ProductCondition;
use Plugin\Ecommerce\Models\ProductHasColors;
use Plugin\Ecommerce\Models\ProductHasChoices;
use Plugin\Ecommerce\Models\ProductTranslation;
use Plugin\Ecommerce\Models\SingleProductPrice;
use Plugin\Ecommerce\Models\ProductCodCountries;
use Plugin\Ecommerce\Models\ProductShippingInfo;
use Plugin\Ecommerce\Models\VariantProductPrice;
use Plugin\Ecommerce\Models\ProductGalleryImages;
use Plugin\Ecommerce\Models\ProductHasCategories;
use Plugin\Ecommerce\Models\ProductHasChoiceOption;
use Plugin\Ecommerce\Repositories\SettingsRepository;
use Plugin\Ecommerce\Models\ProductColorVariantImages;
use Plugin\Ecommerce\Models\ProductVariationCombination;

class Product extends Model
{
    protected $table = "tl_com_products";
    protected $fillable = ['slug'];

    public function translation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->product_translations->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function product_translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }

    public function product_categories()
    {
        return $this->hasMany(ProductHasCategories::class, 'product_id');
    }

    public function product_cats()
    {
        return $this->hasManyThrough(ProductCategory::class, ProductHasCategories::class, 'product_id', 'id', 'id', 'category_id');
    }

    public function brand_info()
    {
        return $this->belongsTo(ProductBrand::class, 'brand');
    }

    public function single_price()
    {
        return $this->belongsTo(SingleProductPrice::class, 'id', 'product_id');
    }

    public function variations()
    {
        return $this->hasMany(VariantProductPrice::class, 'product_id');
    }

    public function choices()
    {
        return $this->hasMany(ProductHasChoices::class, 'product_id');
    }

    public function choice_options()
    {
        return $this->hasMany(ProductHasChoiceOption::class, 'product_id');
    }
    public function color_choices()
    {
        return $this->hasMany(ProductHasColors::class, 'product_id');
    }

    public function variant_combination()
    {
        return $this->hasMany(ProductVariationCombination::class, 'product_id');
    }

    public function shipping_info()
    {
        return $this->belongsTo(ProductShippingInfo::class, 'id', 'product_id');
    }
    public function gallery_images()
    {
        return $this->hasMany(ProductGalleryImages::class, 'product_id');
    }

    public function tags()
    {
        return $this->hasMany(ProductHasTags::class, 'product_id');
    }

    public function tagItems()
    {
        return $this->hasManyThrough(ProductTags::class, ProductHasTags::class, 'product_id', 'id', 'id', 'tag_id');
    }


    public function color_images()
    {
        return $this->hasMany(ProductColorVariantImages::class, 'product_id');
    }

    public function cod_countries()
    {
        return $this->hasMany(ProductCodCountries::class, 'product_id');
    }

    public function codCountryList()
    {
        return $this->hasManyThrough(Country::class, ProductCodCountries::class, 'product_id', 'id', 'id', 'country_id');
    }

    public function cod_states()
    {
        return $this->hasMany(ProductCodState::class, 'product_id');
    }

    public function codStateList()
    {
        return $this->hasManyThrough(States::class, ProductCodState::class, 'product_id', 'id', 'id', 'state_id');
    }

    public function cod_cities()
    {
        return $this->hasMany(ProductCodCities::class, 'product_id');
    }

    public function codCityList()
    {
        return $this->hasManyThrough(Cities::class, ProductCodCities::class, 'product_id', 'id', 'id', 'city_id');
    }

    public function product_seo()
    {
        return $this->belongsTo(ProductSeo::class, 'id', 'product_id');
    }

    public function unit_info()
    {
        return $this->hasOne(Units::class, 'id', 'unit');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
    public function product_condition()
    {
        return $this->belongsTo(ProductCondition::class, 'conditions');
    }

    public function getTotalSaleAttribute()
    {

        return $this->hasMany(OrderHasProducts::class, 'product_id', 'id')->sum('quantity');
    }

    public function orders()
    {
        return $this->hasMany(OrderHasProducts::class, 'product_id', 'id');
    }

    public function getAvgRatingAttribute()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')->avg('rating');
    }

    public function shippingProfile()
    {
        return $this->belongsTo(ShippingProfileProducts::class, 'id', 'product_id');
    }

    public function applicableDiscount()
    {
        $discount = [];
        $is_discount_applicable = Cache::remember('is-product-discount-applicable', 60 * 60, function () {
            return SettingsRepository::getEcommerceSetting('enable_product_discount') == config('settings.general_status.active');
        });
        if ($is_discount_applicable) {
            $has_deal = $this->hasFlashDeal();
            if ($has_deal != null) {
                $discount['discount_amount'] = $has_deal['amount'];
                $discount['discountType'] = $has_deal['discount_type'];
            } else {
                $discount['discount_amount'] = $this->discount_amount;
                $discount['discountType'] = $this->discount_type;
            }
        }

        return $discount;
    }

    public function hasFlashDeal()
    {
        if (isActivePlugin('flashdeal')) {
            $deal_discount = \Plugin\Flashdeal\Models\FlashDealProducts::with(['deal.deal_translations'])
                ->where('product_id', $this->id)
                ->first();

            if ($deal_discount != null && $deal_discount->isExpired() == config('settings.general_status.in_active')) {
                $discount['amount'] = $deal_discount->discount;
                $discount['discount_type'] = $deal_discount->discount_type;
                $discount['deal_title'] = $deal_discount->deal->translation('title', session()->get('api_locale'));
                $discount['end_date'] = $deal_discount->deal->end_date;
                return $discount;
            }
        }

        return null;
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'supplier');
    }

    public function getUnitPriceAttribute()
    {
        $applicable_discount = $this->applicableDiscount();
        $base_price = 0;
        $discount = 0;
        //Base price
        if ($this->has_variant == config('ecommerce.product_variant.single')) {
            $base_price = $this->single_price != null ? $this->single_price->unit_price : 0;
        } else {
            $base_price = $this->variations != null ? $this->variations[0]->unit_price : 0;
        }
        //Calculate discount
        if ($applicable_discount != null && $applicable_discount['discount_amount'] > 0) {
            if ($applicable_discount['discountType'] == config('ecommerce.amount_type.flat')) {
                $discount = $applicable_discount['discount_amount'];
            } else {
                $discount = ($base_price * $applicable_discount['discount_amount']) / 100;
            }
        }
        return $base_price - $discount;
    }
}
