<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;
use App\Models\Lesson;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'image',
        'role',
        'status',
        'password',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* =====================================================
     | COURSES
     ===================================================== */

    /**
     * Courses created / taught by teacher
     */
    public function teachingCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    /**
     * Courses assigned to user (student)
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withTimestamps();
    }

    /* =====================================================
     | TEACHER ↔ USER (ASSIGNMENT)
     ===================================================== */

    /**
     * Teacher → Assigned Users (Students)
     */
    public function assignedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'teacher_user',
            'teacher_id',
            'user_id'
        )->withTimestamps();
    }

    /**
     * User → Assigned Teachers
     */
    public function assignedTeachers()
    {
        return $this->belongsToMany(
            User::class,
            'teacher_user',
            'user_id',
            'teacher_id'
        )->withTimestamps();
    }

    /* =====================================================
     | LESSONS
     ===================================================== */

    /**
     * Lessons created by teacher
     */
    public function createdLessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }

    /**
     * Lessons assigned to user (student progress)
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
            ->withPivot('is_completed')
            ->withTimestamps();
    }

    /* =====================================================
     | ROLE HELPERS
     ===================================================== */

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
