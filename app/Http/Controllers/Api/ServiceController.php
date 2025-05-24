<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::orderByDesc('id');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $services = $query->paginate($perPage);

        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store Request Data:', $request->all());
        Log::info('Has image file:', ['hasFile' => $request->hasFile('image'), 'file' => $request->file('image')]);
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image_slider.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);
        // Xử lý upload image
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgPath = $img->store('uploads/services', 'public');
            $data['image'] = $imgPath;
        }
        // Xử lý upload banner
        if ($request->hasFile('image_banner')) {
            $banner = $request->file('image_banner');
            $bannerPath = $banner->store('uploads/services', 'public');
            $data['image_banner'] = $bannerPath;
        }
        // Xử lý upload slider
        $sliderPaths = [];
        if ($request->hasFile('image_slider')) {
            foreach ($request->file('image_slider') as $sliderImg) {
                $sliderPaths[] = $sliderImg->store('uploads/services', 'public');
            }
        }
        $data['image_slider'] = $sliderPaths;
        $data['slug'] = Str::slug($data['name']);
        $i = 1;
        $baseSlug = $data['slug'];
        while (Service::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $baseSlug . '-' . $i++;
        }
        $service = Service::create($data);
        return response()->json($service, 201);
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
        $service = Service::findOrFail($id);
        Log::info('Update Request Data:', $request->all());
        Log::info('Has image file (Update):', ['hasFile' => $request->hasFile('image'), 'file' => $request->file('image')]);
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image_slider.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $i = 1;
        $baseSlug = $data['slug'];
        while (Service::where('slug', $data['slug'])->where('id', '!=', $service->id)->exists()) {
            $data['slug'] = $baseSlug . '-' . $i++;
        }
        // Xử lý upload image
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $img = $request->file('image');
            $imgPath = $img->store('uploads/services', 'public');
            $data['image'] = $imgPath;
        }
        // Xử lý upload banner
        if ($request->hasFile('image_banner')) {
            if ($service->image_banner) {
                Storage::disk('public')->delete($service->image_banner);
            }
            $banner = $request->file('image_banner');
            $bannerPath = $banner->store('uploads/services', 'public');
            $data['image_banner'] = $bannerPath;
        } else {
            unset($data['image_banner']);
        }
        // Xử lý upload slider
        $sliderPaths = [];
        if ($request->hasFile('image_slider')) {
            // Xóa các ảnh slider cũ
            if (is_array($service->image_slider)) {
                foreach ($service->image_slider as $img) {
                    if ($img) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
            foreach ($request->file('image_slider') as $sliderImg) {
                $sliderPaths[] = $sliderImg->store('uploads/services', 'public');
            }
            $data['image_slider'] = $sliderPaths;
        } else {
            unset($data['image_slider']);
        }
        $service->update($data);
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        // Xóa ảnh image nếu có
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        // Xóa ảnh banner nếu có
        if ($service->image_banner) {
            Storage::disk('public')->delete($service->image_banner);
        }
        // Xóa các ảnh slider nếu có
        if (is_array($service->image_slider)) {
            foreach ($service->image_slider as $img) {
                if ($img) {
                    Storage::disk('public')->delete($img);
                }
            }
        }
        $service->delete();
        return response()->json(['message' => 'Service deleted']);
    }
}
