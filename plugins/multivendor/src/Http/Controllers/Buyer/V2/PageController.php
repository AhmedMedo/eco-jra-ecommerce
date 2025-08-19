<?php

namespace Plugin\Multivendor\Http\Controllers\Buyer\V2;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('plugin/multivendor::buyer.v2.pages.dashboard');
    }

    public function marketplace()
    {
        return view('plugin/multivendor::buyer.v2.pages.marketplace');
    }

    public function accountReview()
    {
        return view('plugin/multivendor::buyer.v2.pages.account-review');
    }

    public function projectDetail($id)
    {
        return view('plugin/multivendor::buyer.v2.pages.project-detail', compact('id'));
    }

    public function certificates()
    {
        return view('plugin/multivendor::buyer.v2.pages.certificates');
    }

    public function reports()
    {
        return view('plugin/multivendor::buyer.v2.pages.reports');
    }

    public function settings()
    {
        return view('plugin/multivendor::buyer.v2.pages.settings');
    }
}
