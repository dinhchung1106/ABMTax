<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SessionController extends Controller
{
    public function index($courseId)
    {
        try {
            Log::info('Fetching sessions for course', ['course_id' => $courseId]);
            
            $course = Course::find($courseId);
            if (!$course) {
                Log::error('Course not found', ['course_id' => $courseId]);
                return response()->json(['message' => 'Không tìm thấy khóa học'], 404);
            }

            $sessions = $course->sessions()->orderBy('order')->get();
            return response()->json($sessions);
        } catch (\Exception $e) {
            Log::error('Error fetching sessions', [
                'course_id' => $courseId,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Lỗi khi tải danh sách buổi học'], 500);
        }
    }

    public function store(Request $request, $courseId)
    {
        try {
            $course = Course::find($courseId);
            if (!$course) {
                return response()->json(['message' => 'Không tìm thấy khóa học'], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'order' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $session = $course->sessions()->create($request->all());
            return response()->json($session, 201);
        } catch (\Exception $e) {
            Log::error('Error creating session', [
                'course_id' => $courseId,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Lỗi khi tạo buổi học'], 500);
        }
    }

    public function update(Request $request, Session $session)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'order' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $session->update($request->all());
            return response()->json($session);
        } catch (\Exception $e) {
            Log::error('Error updating session', [
                'session_id' => $session->id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Lỗi khi cập nhật buổi học'], 500);
        }
    }

    public function destroy(Session $session)
    {
        try {
            // Delete all lessons in this session first
            $session->lessons()->delete();
            $session->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Error deleting session', [
                'session_id' => $session->id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Lỗi khi xóa buổi học'], 500);
        }
    }
} 