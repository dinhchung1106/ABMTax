<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Session;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    // Lấy danh sách bài học của 1 khóa học
    public function index($courseId)
    {
        $lessons = Lesson::where('course_id', $courseId)->orderBy('order')->get();
        return response()->json($lessons);
    }

    // Thêm bài học mới vào buổi học
    public function store(Request $request, Session $session)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'order' => 'nullable|integer',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        $lesson = $session->lessons()->create($data);
        
        return response()->json($lesson, 201);
    }

    // Cập nhật bài học
    public function update(Request $request, Lesson $lesson)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'order' => 'nullable|integer',
            'session_id' => 'required|exists:sessions,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $data = $validator->validated();

        $lesson->update($data);
        return response()->json($lesson);
    }

    // Xóa bài học
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return response()->json(['message' => 'Lesson deleted']);
    }

    // Sắp xếp lại thứ tự bài học
    public function reorder(Request $request, $courseId)
    {
        $orderData = $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|integer|exists:lessons,id',
            'orders.*.order' => 'required|integer',
        ]);
        foreach ($orderData['orders'] as $item) {
            Lesson::where('id', $item['id'])->where('course_id', $courseId)->update(['order' => $item['order']]);
        }
        return response()->json(['message' => 'Order updated']);
    }
} 