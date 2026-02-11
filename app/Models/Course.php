<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\CourseUser;

class Course extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'title',
        'description',
        'price',
        'status',
        'thumbnail',
        'cover_image',
        'trial_video',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'status' => 'boolean',
        'price'  => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // ✅ Users enrolled in course
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->using(CourseUser::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }

    // ✅ Teachers of course
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_user');
    }

    // ✅ Course sections
    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('id');
    }

    // ✅ Course lessons (direct access if needed)
     public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods (Optional but Useful)
    |--------------------------------------------------------------------------
    */

    // ✅ Check if course is free
    public function isFree()
    {
        return $this->price <= 0;
    }

    // ✅ Check if course is active
    public function isPublished()
    {
        return $this->status === true;
    }
}
