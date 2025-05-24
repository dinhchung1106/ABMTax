<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    // Lấy danh sách bài học của 1 khóa học
    public function index($courseId)
    {
        $lessons = Lesson::where('course_id', $courseId)->orderBy('order')->get();
        return response()->json($lessons);
    }

    // Thêm bài học mới vào khóa học
    public function store(Request $request, $courseId)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);
        $data['course_id'] = $courseId;
        if (!isset($data['order'])) {
            $maxOrder = Lesson::where('course_id', $courseId)->max('order');
            $data['order'] = $maxOrder + 1;
        }
        $lesson = Lesson::create($data);
        return response()->json($lesson, 201);
    }

    // Cập nhật bài học
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);
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