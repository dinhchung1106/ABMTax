<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::orderByDesc('id');

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $news = $query->with(['category', 'author', 'tags'])->paginate($perPage);

        $news->getCollection()->transform(function ($item) {
            $item->category_name = $item->category ? $item->category->name : 'N/A';
            $item->author_name = $item->author ? $item->author->name : 'N/A';
            return $item;
        });

        return response()->json($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store Request Data:', $request->all());
        Log::info('Has image file:', ['hasFile' => $request->hasFile('image'), 'file' => $request->file('image')]);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'nullable|boolean',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id',
            'seo_keywords' => 'nullable|string|max:255',
            'views' => 'nullable|integer|min:0',
        ]);

        $data['author_id'] = Auth::id();

        // Generate slug from title
        $slug = Str::slug($data['title']);
        $count = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = Str::slug($data['title']) . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        // Handle image upload
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgPath = $img->store('uploads/news', 'public');
            $data['image'] = $imgPath;
        }

        $news = News::create($data);

        if (isset($data['tag_ids'])) {
            $news->tags()->sync($data['tag_ids']);
        }

        $news->load(['category', 'author', 'tags']);
        $news->category_name = $news->category ? $news->category->name : 'N/A';
        $news->author_name = $news->author ? $news->author->name : 'N/A';

        return response()->json($news, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::with(['category', 'author', 'tags'])->findOrFail($id);
        $news->category_name = $news->category ? $news->category->name : 'N/A';
        $news->author_name = $news->author ? $news->author->name : 'N/A';
        return response()->json($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        Log::info('Update Request Data:', $request->all());
        Log::info('Has image file (Update):', ['hasFile' => $request->hasFile('image'), 'file' => $request->file('image')]);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'nullable|boolean',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id',
            'seo_keywords' => 'nullable|string|max:255',
            'views' => 'nullable|integer|min:0',
        ]);

        // Generate slug from title if title is changed
        if ($data['title'] !== $news->title) {
            $slug = Str::slug($data['title']);
            $count = 1;
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = Str::slug($data['title']) . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $img = $request->file('image');
            $imgPath = $img->store('uploads/news', 'public');
            $data['image'] = $imgPath;
        } else if ($request->has('remove_image') && $request->remove_image) {
            $data['image'] = null;
        }

        $news->update($data);

        if (isset($data['tag_ids'])) {
            $news->tags()->sync($data['tag_ids']);
        } else {
            $news->tags()->detach();
        }

        $news->load(['category', 'author', 'tags']);
        $news->category_name = $news->category ? $news->category->name : 'N/A';
        $news->author_name = $news->author ? $news->author->name : 'N/A';

        return response()->json($news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        // Xóa ảnh nếu có
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return response()->json(['message' => 'News deleted']);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);
        $img = $request->file('file');
        $imgPath = $img->store('uploads/news', 'public');
        return response()->json(['url' => Storage::url($imgPath)]);
    }
}
