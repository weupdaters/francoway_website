<?php

namespace App\Models;

use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\User;
use App\Models\CourseUserSubscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'has_custom_prompt',
        'custom_prompt',
        'teacher_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'status' => 'boolean',
        'price' => 'float',
        'has_custom_prompt' => 'boolean',
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

    //plan
    public function plans()
    {
        return $this->hasMany(SubscriptionPlan::class);
    }
    // ✅ Course subscriptions
    public function courseUserSubscription()
    {
        return $this->hasMany(CourseUserSubscription::class);
    }

    //teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    //

}
