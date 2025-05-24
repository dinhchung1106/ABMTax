<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RolePermissionController extends Controller
{
    // Get all roles with their permissions
    public function getRoles()
    {
        $roles = Role::with('permissions')->get(); // Eager load permissions
        return response()->json($roles);
    }

    // Get current user's permissions
    public function getPermissions()
    {
        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name');
        return response()->json($permissions);
    }

    // Create a new role and assign permissions
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $role = Role::create(['name' => $request->name]);

        // Assign permissions by name (assuming permissions array contains names)
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        // Return the role with its permissions
        $role->load('permissions');
        return response()->json($role, 201);
    }

    // Update an existing role and sync permissions
    public function update(Request $request, Role $role)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $role->update(['name' => $request->name]);

        // Sync permissions by name (assuming permissions array contains names)
         if ($request->has('permissions')) {
             $role->syncPermissions($request->permissions);
         } else {
             $role->syncPermissions([]); // Remove all permissions if none are provided
         }

        // Return the updated role with its permissions
        $role->load('permissions');
        return response()->json($role);
    }

    // Delete a role
    public function destroy(Role $role)
    {
        // Prevent deleting the Super Admin role (optional but recommended)
        if ($role->name === 'Super Admin') {
            return response()->json(['message' => 'Cannot delete Super Admin role.'], 403);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully.']);
    }
} 