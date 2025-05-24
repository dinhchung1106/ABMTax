<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInfo;
use App\Models\Service;
use App\Models\News;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanyInfo::first();
        $services = Service::where('status', 1)->limit(6)->get();
        $news = News::where('status', 1)->orderByDesc('created_at')->limit(3)->get();
        $courses = Course::where('status', 1)->orderByDesc('start_date')->limit(2)->get();
        return view('frontend.home', compact('company', 'services', 'news', 'courses'));
    }
}
