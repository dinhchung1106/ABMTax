<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Thông tin đăng nhập không đúng'], 401);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Đăng xuất thành công']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user()->load('roles'));
    }

    public function updateMe(Request $request)
    {
        $user = Auth::user();

        // Validate all fields, including the image as a nullable file
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096', // Validate as nullable image file
            'password' => 'nullable|string|min:8|confirmed',
            'remove_image' => 'nullable|boolean', // Validate the remove_image flag
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // A new file was uploaded - delete old one and store new one
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $request->file('image')->store('uploads/users', 'public');
        } else if ($request->has('remove_image') && $request->remove_image) {
            // Request to remove the image - delete old one and set to null
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = null;
        } else {
             // No new file and no remove_image flag
             // Keep the existing image if $user->image is not null.
             // If frontend did not send the 'image' field, it won't be in $data,
             // which means fill() won't change user->image unless it was removed.
             // If frontend sent 'image' as a string (old URL), it won't pass file validation,
             // and $data['image'] will not be set by validation, so user->image remains.
             // Explicitly ensure image key is handled if keeping existing or no image.
             if (!array_key_exists('image', $data) && $user->image) {
                  // Frontend didn't send image and user had one - keep it.
                  $data['image'] = $user->image;
             } else if (!array_key_exists('image', $data) && !$user->image) {
                  // Frontend didn't send image and user had none - keep it null.
                  $data['image'] = null;
             }
             // If array_key_exists('image', $data) is true here, it means validation failed for the 'image' field (e.g., sent string won't pass image validation).
             // In that case, $data['image'] will not exist, and the logic above ensures we either keep the old one or set to null.
        }

        // Update user fields using the $data array, which now correctly includes 'image' or null
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'image' => $data['image'] ?? null, // Assign the image path from $data
        ]);

        // Update password if provided
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        // Load roles before returning
        $user->load('roles');

        return response()->json($user);
    }
}
