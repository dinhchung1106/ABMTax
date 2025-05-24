<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'status', 'slug', 'image', 'image_banner', 'image_slider'
    ];

    protected $casts = [
        'image_slider' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
