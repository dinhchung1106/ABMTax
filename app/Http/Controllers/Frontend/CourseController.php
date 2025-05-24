<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $company = \App\Models\CompanyInfo::first();
        $query = \App\Models\Course::where('status', 1);
        // Filter theo tên
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        // Filter theo học phí
        if ($request->filled('fee')) {
            if ($request->fee == 'low') {
                $query->where('fee', '<', 1000000);
            } elseif ($request->fee == 'mid') {
                $query->whereBetween('fee', [1000000, 3000000]);
            } elseif ($request->fee == 'high') {
                $query->where('fee', '>', 3000000);
            }
        }
        // Filter theo trạng thái khai giảng
        if ($request->filled('status')) {
            if ($request->status == 'upcoming') {
                $query->where('start_date', '>', now());
            } elseif ($request->status == 'ongoing') {
                $query->where('start_date', '<=', now())->where('end_date', '>=', now());
            } elseif ($request->status == 'ended') {
                $query->where('end_date', '<', now());
            }
        }
        $courses = $query->orderByDesc('start_date')->paginate(6)->withQueryString();
        return view('frontend.courses', compact('company', 'courses'));
    }

    public function show(\App\Models\Course $course)
    {
        $company = \App\Models\CompanyInfo::first();
        $lessons = $course->lessons()->orderBy('order')->get();
        return view('frontend.course_detail', compact('company', 'course', 'lessons'));
    }
}
