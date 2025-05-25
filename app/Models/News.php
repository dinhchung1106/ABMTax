<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'image', 'category_id', 'status', 'author_id', 'views', 'seo_keywords', 'slug'
    ];

    /**
     * Get the category that the news belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author of the news.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the tags for the news.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'new_tag');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
