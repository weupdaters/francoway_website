<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseUser extends Pivot
{
    protected $table = 'course_user';

    protected $fillable = [
        'course_id',
        'user_id',
        'status',
    ];

    public $timestamps = true;

    // 🔹 Course Relation
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // 🔹 User Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}