<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function index(Session $session)
    {
        $lessons = $session->lessons()->orderBy('order')->get();
        return response()->json($lessons);
    }

    public function store(Request $request, Session $session)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
            'course_id' => 'required|exists:courses,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lesson = $session->lessons()->create($request->all());
        return response()->json($lesson, 201);
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
            'session_id' => 'required|exists:sessions,id',
            'course_id' => 'required|exists:courses,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lesson->update($request->all());
        return response()->json($lesson);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return response()->json(null, 204);
    }
} 