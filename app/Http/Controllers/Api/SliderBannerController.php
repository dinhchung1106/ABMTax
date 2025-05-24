<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\SliderBanner;

class SliderBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = SliderBanner::orderBy('order')->get();
        return response()->json($banners);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_banner_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/uploads/banners', $imageName);
        }

        // Create new banner
        $banner = SliderBanner::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $imagePath ? Storage::url($imagePath) : null,
            'link' => $validatedData['link'],
            'button_text' => $validatedData['button_text'],
            'status' => $validatedData['status'],
            'order' => $validatedData['order'],
        ]);

        return response()->json($banner, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // This method is not strictly needed if only listing and using dialog for create/edit
        // But we can add a basic implementation for completeness
        $banner = SliderBanner::find($id);
        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }
        return response()->json($banner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = SliderBanner::find($id);
        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            // Image is not required on update, but if present, validate it
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'order' => 'required|integer|min:0',
            'remove_image' => 'nullable|boolean', // Flag to indicate image removal
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $imagePath = $banner->getRawOriginal('image'); // Get the raw stored path

        // Handle image update/removal
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($banner->image && Storage::exists(str_replace('/storage', 'public', $banner->image))) {
                 Storage::delete(str_replace('/storage', 'public', $banner->image));
            }
            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_banner_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/uploads/banners', $imageName);
             $validatedData['image'] = Storage::url($imagePath); // Update validated data with new URL
        } elseif (isset($validatedData['remove_image']) && $validatedData['remove_image'] && $banner->image) {
             // Remove image if requested and exists
              if (Storage::exists(str_replace('/storage', 'public', $banner->image))) {
                 Storage::delete(str_replace('/storage', 'public', $banner->image));
              }
            $validatedData['image'] = null; // Set image to null in validated data
        } else {
             // If no new image and no removal requested, keep the existing image path
             // Ensure the image field is not overwritten in validatedData if no file or removal flag
              unset($validatedData['image']);
        }

        // Update banner
        $banner->update($validatedData);

        return response()->json($banner);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = SliderBanner::find($id);
        if (!$banner) {
            return response()->json(['message' => 'Banner not found'], 404);
        }

        // Delete image if it exists
        if ($banner->image && Storage::exists(str_replace('/storage', 'public', $banner->image))) {
             Storage::delete(str_replace('/storage', 'public', $banner->image));
        }

        $banner->delete();

        return response()->json(['message' => 'Banner deleted successfully']);
    }
}
