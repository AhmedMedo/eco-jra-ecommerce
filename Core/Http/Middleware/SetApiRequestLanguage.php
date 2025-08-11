<?php

namespace Core\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SetApiRequestLanguage
{

    public function handle(Request $request, Closure $next)
    {
        // List of locales your app actually has under resources/lang
        $supported = ['en', 'ar'];

        // Use Laravel's built-in negotiation
        $locale = $request->getPreferredLanguage($supported) ?? config('app.locale', 'en');

        // Normalize (optional safety)
        $locale = Str::of($locale)->replace('_', '-')->lower();
        $locale = in_array((string)$locale, $supported, true) ? (string)$locale : 'en';

        app()->setLocale($locale);
        Carbon::setLocale($locale);      // keep Carbon in sync

        session(['api_locale' => $locale]);

        return $next($request);
    }

}
