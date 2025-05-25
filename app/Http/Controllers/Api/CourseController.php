<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Temporary debug logic
        $user = Auth::user();
        if ($user) {
            $canViewCourses = $user->can('view_courses');
            Log::info('API Courses Index: User Authenticated', ['user_id' => $user->id, 'can_view_courses' => $canViewCourses]);
             if (!$canViewCourses) {
                 Log::warning('API Courses Index: User lacks view_courses permission', ['user_id' => $user->id]);
             }
        } else {
            Log::warning('API Courses Index: User not authenticated');
        }
        // End temporary debug logic

        $query = Course::with('lessons');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('schedule', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $courses = $query->paginate($perPage);

        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store Course Request Data:', $request->all());
        Log::info('Has image file:', ['hasFile' => $request->hasFile('image'), 'file' => $request->file('image')]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fee' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'schedule' => 'nullable|string',
            'discount_value' => 'nullable|numeric|min:0',
            'discount_type' => ['nullable', 'string', Rule::in(['fixed', 'percentage'])],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'status' => ['nullable', 'integer', Rule::in([Course::STATUS_OPEN, Course::STATUS_CLOSED, Course::STATUS_DRAFT])],
        ]);

        // Xử lý upload image
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgPath = $img->store('uploads/courses', 'public');
            $data['image'] = $imgPath;
        }

        $data['slug'] = Str::slug($data['name']);
        $i = 1;
        $baseSlug = $data['slug'];
        while (Course::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $baseSlug . '-' . $i++;
        }

        $course = Course::create($data);
        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        Log::info('Update Course Request Data:', $request->all());
        Log::info('Has image file (Update):', ['hasFile' => $request->hasFile('image'), 'file' => $request->file('image')]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fee' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'schedule' => 'nullable|string',
            'discount_value' => 'nullable|numeric|min:0',
            'discount_type' => ['nullable', 'string', Rule::in(['fixed', 'percentage'])],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'status' => ['nullable', 'integer', Rule::in([Course::STATUS_OPEN, Course::STATUS_CLOSED, Course::STATUS_DRAFT])],
        ]);

        // Xử lý upload image
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $img = $request->file('image');
            $imgPath = $img->store('uploads/courses', 'public');
            $data['image'] = $imgPath;
        }

        if ($request->has('name') && $request->name !== $course->name) {
            $data['slug'] = Str::slug($request->name);
            $i = 1;
            $baseSlug = $data['slug'];
            while (Course::where('slug', $data['slug'])->where('id', '!=', $course->id)->exists()) {
                $data['slug'] = $baseSlug . '-' . $i++;
            }
        }

        $course->update($data);
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        // Delete course image if exists
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        
        $course->delete();
        return response()->json(['message' => 'Course deleted']);
    }
}
