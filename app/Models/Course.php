<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;
    const STATUS_DRAFT = 3;

    public static array $statusTexts = [
        self::STATUS_OPEN => 'Mở đăng ký',
        self::STATUS_CLOSED => 'Đã đóng',
        self::STATUS_DRAFT => 'Nháp',
    ];

    protected $fillable = [
        'name', 'description', 'fee', 'start_date', 'schedule', 'discount_value', 'discount_type', 'image', 'status', 'slug'
    ];

    protected $appends = ['image_url'];

    public function lessons()
    {
        return $this->hasMany(\App\Models\Lesson::class);
    }

    /**
     * Get the sessions for the course.
     */
    public function sessions()
    {
        return $this->hasMany(Session::class)->orderBy('order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the full URL for the course image
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('uploads/no-image-available.png');
        }
        return asset('storage/' . $this->image);
    }

    /**
     * Delete the course image from storage
     */
    public function deleteImage()
    {
        if ($this->image) {
            Storage::delete('public/' . $this->image);
            $this->image = null;
            $this->save();
        }
    }
}
