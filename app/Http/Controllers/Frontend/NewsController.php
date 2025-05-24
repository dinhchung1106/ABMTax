<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $company = \App\Models\CompanyInfo::first();
        $news = \App\Models\News::where('status', 1)->orderByDesc('created_at')->paginate(6);
        return view('frontend.news', compact('company', 'news'));
    }

    public function show($id)
    {
        $company = \App\Models\CompanyInfo::first();
        $news = \App\Models\News::where('status', 1)->findOrFail($id);
        return view('frontend.news_detail', compact('company', 'news'));
    }
}
