<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Section;
use App\Models\User;
use App\Models\Comment;

class Lesson extends Model
{
    use HasFactory;

    /*
    |------------------------------------------------------------------
    | Fillable
    |------------------------------------------------------------------
    */
    protected $fillable = [
        'course_id',
        'section_id',
        'teacher_id',     // 🔥 important (lesson owner)
        'title',
        'video_url',
        'description',
        'type',           // video | audio | text
        'duration',       // 10:25
    ];

    /*
    |------------------------------------------------------------------
    | Casts
    |------------------------------------------------------------------
    */
    protected $casts = [
        'course_id'  => 'integer',
        'section_id' => 'integer',
        'teacher_id' => 'integer',
    ];

    /*
    |------------------------------------------------------------------
    | Relationships
    |------------------------------------------------------------------
    */

    /**
     * Lesson belongs to a Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Lesson belongs to a Section
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Lesson belongs to a Teacher (User with role=teacher)
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Lesson comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Users who attempted/completed this lesson
     * Pivot table: lesson_user
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_user')
            ->withPivot('is_completed', 'completed_at')
            ->withTimestamps();
    }

    /*
    |------------------------------------------------------------------
    | Helper Methods
    |------------------------------------------------------------------
    */

    /**
     * Check if lesson is completed by given user
     */
    public function isCompletedBy(User $user): bool
    {
        return $this->users()
            ->where('user_id', $user->id)
            ->wherePivot('is_completed', true)
            ->exists();
    }

    /**
     * Check if lesson belongs to logged-in teacher
     */
    public function ownedByTeacher(User $teacher): bool
    {
        return $this->teacher_id === $teacher->id;
    }
}
