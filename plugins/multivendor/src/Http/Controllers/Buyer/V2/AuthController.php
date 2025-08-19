<?php

namespace Plugin\Multivendor\Http\Controllers\Buyer\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Core\Models\User;
use Plugin\Multivendor\Models\BuyerKycDocument;

class AuthController extends Controller
{
    public function login()
    {
        return view('plugin/multivendor::buyer.v2.auth.login');
    }

    public function loginAttempt(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('plugin.multivendor.buyer.v2.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('plugin/multivendor::buyer.v2.auth.register');
    }

    /**
     * Handle buyer registration attempt and login
     */
    public function registerAttempt(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:tl_users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'vat_number' => 'nullable|string|max:100',
            'kyc_files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // 10MB max
            'agree' => 'required|accepted'
        ]);

        try {
            \DB::beginTransaction();

            $user = new User();
            $user->name = $validated['first_name'] . ' ' . $validated['last_name'];
            $user->first_name = $validated['first_name'];
            $user->last_name = $validated['last_name'];
            $user->company_name = $validated['company_name'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'];
            $user->password = Hash::make($validated['password']);
            $user->vat_number = $validated['vat_number'];
            $user->status = 1;
            $user->user_type = 2; // buyer user type
            $user->account_status = 'pending';
            $user->saveOrFail();

            // Handle KYC file uploads
            if ($request->hasFile('kyc_files')) {
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
            }

            \DB::commit();

            // Send verification email
            $user->sendEmailVerificationNotification();

            Auth::login($user);

            return redirect()->route('plugin.multivendor.buyer.v2.account-review');

        } catch (\Exception $e) {
            \DB::rollBack();
            throw \Illuminate\Validation\ValidationException::withMessages([
                'registration_error' => ['Registration failed. Please try again.'. $e->getMessage()]
            ]);
        }
    }

    /**
     * Detect document type based on file name or content
     */
    private function detectDocumentType($file)
    {
        $filename = strtolower($file->getClientOriginalName());
        
        if (str_contains($filename, 'license') || str_contains($filename, 'business')) {
            return 'business_license';
        } elseif (str_contains($filename, 'id') || str_contains($filename, 'identity')) {
            return 'id_card';
        } elseif (str_contains($filename, 'passport')) {
            return 'passport';
        } elseif (str_contains($filename, 'tax') || str_contains($filename, 'vat')) {
            return 'tax_document';
        } else {
            return 'other';
        }
    }

    /**
     * Show the form to request a password reset link
     */
    public function showForgotPasswordForm()
    {
        return view('plugin/multivendor::buyer.v2.auth.forgot-password');
    }

    /**
     * Send a reset link to the given user
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = \Illuminate\Support\Facades\Password::sendResetLink(
            $request->only('email')
        );

        return $status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Display the password reset view for the given token
     */
    public function showResetForm(Request $request, $token)
    {
        return view('plugin/multivendor::buyer.v2.auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Reset the given user's password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = \Illuminate\Support\Facades\Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();
            }
        );

        return $status === \Illuminate\Support\Facades\Password::PASSWORD_RESET
                    ? redirect()->route('plugin.multivendor.buyer.v2.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Mark the authenticated user's email address as verified
     */
    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            throw new \Illuminate\Auth\Access\AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('plugin.multivendor.buyer.v2.dashboard');
        }

        if ($user->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($user));
        }

        return redirect()->route('plugin.multivendor.buyer.v2.dashboard')->with('status', 'Your email has been verified!');
    }

    /**
     * Resend the email verification notification
     */
    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return back()->with('status', 'Your email is already verified.');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link sent!');
    }

    /**
     * Show the email verification notice
     */
    public function showVerificationNotice()
    {
        return view('plugin/multivendor::buyer.v2.auth.verify-email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('plugin.multivendor.buyer.v2.login');
    }
}
