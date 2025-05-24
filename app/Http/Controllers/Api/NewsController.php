<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

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
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $news = $query->paginate($perPage);

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
            'category' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);
        $news = News::create($data);
        return response()->json($news, 201);
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
        $news = News::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'category' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);
        $news->update($data);
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
