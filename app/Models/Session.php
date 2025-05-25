<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'order',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
        'order' => 'integer'
    ];

    /**
     * Get the course that owns the session.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the lessons for the session.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
