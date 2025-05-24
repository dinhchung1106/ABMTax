<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $company = \App\Models\CompanyInfo::first();
        return view('frontend.about', compact('company'));
    }
}
