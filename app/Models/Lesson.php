<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'course_id',
        'title',
        'description',
        'content',
        'order',
        'status',
        'duration'
    ];

    /**
     * Get the session that owns the lesson.
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * Get the course that owns the lesson.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
} 