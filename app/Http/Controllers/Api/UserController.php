<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('roles');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $perPage = $request->get('per_page', 10);
        $users = $query->paginate($perPage);

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roles' => 'required|array',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/users', 'public');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'address' => $validated['address'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'image' => $validated['image'] ?? null,
        ]);

        $user->syncRoles($validated['roles']);

        return response()->json($user->load('roles'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('roles');
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Debug log
        \Log::info('Update User Request Data:', [
            'all' => $request->all(),
            'roles' => $request->input('roles'),
            'has_roles' => $request->has('roles'),
            'content_type' => $request->header('Content-Type')
        ]);

        // Get all input data
        $input = $request->all();
        
        // Handle roles from FormData
        if ($request->has('roles')) {
            $roles = $request->input('roles');
            if (is_string($roles)) {
                $decodedRoles = json_decode($roles, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $input['roles'] = $decodedRoles;
                }
            }
        }

        \Log::info('Processed Input Data:', ['input' => $input]);

        // Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'roles' => 'required|array',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Only add password validation if password is provided
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }

        // Validate the input
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            \Log::error('Validation failed:', ['errors' => $validator->errors()->toArray()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        \Log::info('Validated Data:', ['validated' => $validated]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $validated['image'] = $request->file('image')->store('uploads/users', 'public');
        }

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ];

        if (isset($validated['image'])) {
            $userData['image'] = $validated['image'];
        }

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);
        $user->syncRoles($validated['roles']);

        return response()->json($user->load('roles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting the current authenticated user (optional)
        if (auth()->user()->id === $user->id) {
             return response()->json(['message' => 'Cannot delete the currently authenticated user.'], 403);
        }

        // Prevent deleting user with Super Admin role (optional)
        if ($user->hasRole('Super Admin')) {
             return response()->json(['message' => 'Cannot delete a user with the Super Admin role.'], 403);
        }

        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
