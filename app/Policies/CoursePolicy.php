<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\TeacherAssignUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher()) {
            return TeacherAssignUser::where('teacher_id', $user->id)
                ->where('course_id', $course->id)
                ->exists();
        }

        return true;
    }

    /**
     * Determine whether the user can manage/update the course.
     */
    public function update(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher()) {
            return TeacherAssignUser::where('teacher_id', $user->id)
                ->where('course_id', $course->id)
                ->exists();
        }

        return false;
    }

    /**
     * Determine whether the user can delete the course.
     */
    public function delete(User $user, Course $course): bool
    {
        return $user->isAdmin();
    }
}
