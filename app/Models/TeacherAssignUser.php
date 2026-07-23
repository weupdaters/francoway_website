<?php

namespace App\Models;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAssignUser extends Model
{
    use HasFactory;

    protected $table = 'teacher_assign_user';

    protected $fillable = [
        'teacher_id',
        'user_id',
        'course_id',
    ];

    // 🔹 Teacher (users table)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // 🔹 Student (users table)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔹 Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    
}
