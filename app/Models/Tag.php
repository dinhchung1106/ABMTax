<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'status'
    ];

    /**
     * Get the news that are associated with this tag.
     */
    public function news()
    {
        return $this->belongsToMany(News::class, 'new_tag');
    }
}
