<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollaboratorController extends Controller
{
    public function index(Request $request)
    {
        $query = Collaborator::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $collaborators = $query->orderBy('created_at', 'desc')
                             ->paginate($perPage);

        return response()->json($collaborators);
    }

    public function updateStatus(Request $request, Collaborator $collaborator)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:approved,rejected',
            'reason' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($collaborator->status !== 'pending') {
            return response()->json([
                'message' => 'Chỉ có thể cập nhật trạng thái của cộng tác viên đang ở trạng thái chờ duyệt'
            ], 400);
        }

        $collaborator->update([
            'status' => $request->status,
            'reason' => $request->reason
        ]);

        return response()->json([
            'message' => 'Cập nhật trạng thái thành công',
            'data' => $collaborator
        ]);
    }
}
