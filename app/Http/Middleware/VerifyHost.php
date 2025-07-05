<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyHost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $res = $this->verifyHost();
        if (!$res && env('IS_USER_REGISTERED') == 1) {
            return redirect()->route('core.license.active');
        }
        return $next($request);
    }


    public function verifyHost()
    {
        require_once base_path('FashlyBase.php');
        $ob = new  \FashlyBase();
        $oldResponse = $ob->getOldResponse();

        if ($oldResponse == null) {
            return false;
        }

        if ($oldResponse != null) {
            if ($oldResponse->is_valid && $oldResponse->next_request > time()) {
                $errorMessage = "";
                $responseObj = null;
                $version = $oldResponse->version;
                $licenseKey = $oldResponse->license_key;
                $adminEmail = $oldResponse->email;

                if (\FashlyBase::CheckLicense($licenseKey, $errorMessage, $responseObj, $version, $adminEmail)) {
                    if ($responseObj->is_valid) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
