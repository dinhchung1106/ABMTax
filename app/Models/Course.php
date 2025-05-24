<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'fee', 'start_date', 'schedule', 'discount_info', 'image', 'status', 'slug'
    ];

    public function lessons()
    {
        return $this->hasMany(\App\Models\Lesson::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
