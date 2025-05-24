<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $company = \App\Models\CompanyInfo::first();
        $services = \App\Models\Service::where('status', 1)->get();
        return view('frontend.services', compact('company', 'services'));
    }

    public function show($slug)
    {

        $service = \App\Models\Service::where('status', 1)->firstOrFail();
        $company = \App\Models\CompanyInfo::first();
        return view('frontend.service_detail', compact('service', 'company'));
    }
}
