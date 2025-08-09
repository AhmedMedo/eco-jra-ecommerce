<?php

namespace Plugin\Multivendor\Http\Controllers\Seller\V2;

use App\Http\Controllers\Controller;
use Core\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Plugin\Multivendor\Http\Requests\SellerLoginRequest;

class AuthController extends Controller
{
    /**
     * Show v2 login page
     */
    public function login()
    {
        if (auth()->user() != null && auth()->user()->user_type == config('ecommerce.user_type.seller')) {
            return to_route('plugin.multivendor.seller.v2.dashboard');
        }
        return view('plugin/multivendor::seller.v2.auth.login');
    }

    /**
     * Attempt login for v2; reuse same rules and redirect to v2 dashboard on success
     */
    public function loginAttempt(SellerLoginRequest $request)
    {
        $seller = User::where('email', $request['email'])
            ->where('user_type', config('ecommerce.user_type.seller'))
            ->first();

        if ($seller == null) {
            throw ValidationException::withMessages([
                'login_error' => [translate('No Account found associate this email')]
            ]);
        }

        if ($seller != null && $seller->status != config('settings.general_status.active')) {
            throw ValidationException::withMessages([
                'login_error' => [translate('Your account is not active. Please contact with administration')]
            ]);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            toastNotification('success', translate('Login successful'));
            return redirect()->route('plugin.multivendor.seller.v2.dashboard');
        }

        throw ValidationException::withMessages([
            'login_error' => [translate('Login Credentials Does not Match')]
        ]);
    }
}


