<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'nullable|boolean',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id',
        ]);

        $data['author_id'] = Auth::id();

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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'nullable|boolean',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id',
        ]);

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
        $news->delete();
        return response()->json(['message' => 'News deleted']);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);
        $path = $request->file('file')->store('news', 'public');
        return response()->json(['url' => asset('storage/' . $path)]);
    }
}
