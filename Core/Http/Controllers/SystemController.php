<?php

namespace Core\Http\Controllers;

use Core\Models\Themes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    private $system_latest_version = "1.0.0";

    /**
     * Will clear system  cache
     */
    public function clearSystemCache()
    {
        try {
            cache_clear();
            toastNotification('success', translate('Cache clear successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            toastNotification('error', translate('Cache clear failed'));
        }
    }

    /**
     * Will clear system  cache
     */
    public function clearSystemCacheFromApi()
    {
        try {
            cache_clear();
            return response()->json(
                [
                    'success' => true,
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                ]
            );
        }
    }

    public function activateLicense(Request $request)
    {
        $request->validate([
            'license' => 'required|max:350'
        ]);

        $errorMessage = "";
        $responseObj = null;
        $version = $this->system_latest_version;
        $licenseKey = $request['license'];
        $adminEmail = auth()->user()->email;
        try {
            require_once base_path('FashlyBase.php');
            if (\FashlyBase::CheckLicense($licenseKey, $errorMessage, $responseObj, $version, $adminEmail)) {
                if ($responseObj->is_valid) {
                    $this->updateSystemVersion($this->system_latest_version);
                    $this->updatePluginVersion($this->system_latest_version, $request['license']);
                    $this->updateThemeVersion($this->system_latest_version, $request['license']);
                    $this->setProductSeller();
                    if (isActivePlugin('multivendor')) {
                        $this->storeInHouseShopInfo();
                    }
                    toastNotification('success', $responseObj->msg, 'Success');
                    return redirect()->route('core.admin.welcome');
                }
            } else {
                return redirect()->back()->withErrors(['message' => $errorMessage]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Something went wrong']);
        }
    }

    /**
     * Will update system version
     */

    public function updateSystemVersion($updated_version)
    {
        try {
            DB::beginTransaction();
            $version_setting_id = getGeneralSettingId('system_version');
            $version_data = [
                'settings_id' => $version_setting_id,
                'value' => $updated_version
            ];
            //Delete Exiting Version
            DB::table('tl_general_settings_has_values')
                ->where('settings_id', $version_setting_id)
                ->delete();

            //Store new Version
            DB::table('tl_general_settings_has_values')
                ->where('settings_id', $version_setting_id)
                ->insert($version_data);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        } catch (\Error $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Will updated plugin versions
     */
    public function updatePluginVersion($updated_version, $purchase_key)
    {
        try {
            DB::beginTransaction();
            Plugin::update(
                [
                    'version' => $updated_version,
                    'unique_indentifier' => $purchase_key
                ]
            );
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        } catch (\Error $e) {
            DB::rollBack();
            return false;
        }
    }
    /**
     * Will updated theme versions
     */
    public function updateThemeVersion($updated_version, $purchase_key)
    {
        try {
            DB::beginTransaction();
            Themes::query()->update(
                [
                    'version' => $updated_version,
                    'unique_indentifier' => $purchase_key
                ]
            );

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        } catch (\Error $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Store system name
     */
    public function storeInHouseShopInfo()
    {
        $system_name = DB::table('tl_general_settings_has_values')->where('settings_id', getGeneralSettingId('system_name'))->first();
        $shop_name = $system_name != null ? $system_name->value : 'Store';
        $shop = new \Plugin\Multivendor\Models\SellerShop;
        $shop->shop_name = $shop_name;
        $shop->shop_slug = Str::slug($shop_name);
        $shop->seller_id = getSupperAdminId();
        $shop->status = config('settings.general_status.active');
        $shop->save();

        //store in-house shop id
        $config = \Plugin\Ecommerce\Models\EcommerceConfig::firstOrCreate(['key_name' => 'in_house_shop_id']);
        $config->key_value = $shop->id;
        $config->save();
    }

    /**
     * Will set products seller
     */
    public function setProductSeller()
    {
        //Update Product
        \Plugin\Ecommerce\Models\Product::whereNull('supplier')->update(
            [
                'supplier' => getSupperAdminId()
            ]
        );

        //Update order products
        \Plugin\Ecommerce\Models\OrderHasProducts::whereNull('seller_id')->update(
            [
                'seller_id' => getSupperAdminId()
            ]
        );
        //Update page 
        \Core\Models\TlPage::whereNull('user_id')->update(
            [
                'user_id' => getSupperAdminId()
            ]
        );
    }

    /**
     * Will update license list
     */
    public function licenseList()
    {
        require_once base_path('FashlyBase.php');
        $ob = new  \FashlyBase();
        $response = $ob->getOldResponse();
        return view('core::base.system.license.list', ['license' => $response]);
    }

    /**
     * Will remove a license
     */
    public function licenseRemove(Request $request)
    {
        try {
            require_once base_path('FashlyBase.php');
            $errorMessage = "";
            $version = "";
            if (\FashlyBase::RemoveLicenseKey($errorMessage, $version)) {
                toastNotification('success', 'License Removed successfully', 'Success');
                return to_route('app.system.license.list');
            } else {
                toastNotification('error', $errorMessage, 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            toastNotification('error', 'License remove failed', 'Error');
            return redirect()->back();
        }
    }
}
