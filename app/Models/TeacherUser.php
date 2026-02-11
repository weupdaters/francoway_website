<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Course;

class TeacherUser extends Model
{
    use HasFactory;

    protected $table = 'teacher_user';

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
        return $this->belongsTo(Course::class);
    }
}
