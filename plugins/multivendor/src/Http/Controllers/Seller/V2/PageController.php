<?php

namespace Plugin\Multivendor\Http\Controllers\Seller\V2;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('plugin/multivendor::seller.v2.pages.dashboard');
    }

    public function marketplace()
    {
        return view('plugin/multivendor::seller.v2.pages.marketplace');
    }

    public function certificates()
    {
        return view('plugin/multivendor::seller.v2.pages.certificates');
    }

    public function reports()
    {
        return view('plugin/multivendor::seller.v2.pages.reports');
    }

    public function settings()
    {
        return view('plugin/multivendor::seller.v2.pages.settings');
    }
}


