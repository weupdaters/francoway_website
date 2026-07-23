<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\TeacherAssignUser;
use App\Models\User;

class LessonPolicy
{
    /**
     * Determine whether the user can view the lesson.
     */
    public function view(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher()) {
            return TeacherAssignUser::where('teacher_id', $user->id)
                ->where('course_id', $lesson->course_id)
                ->exists();
        }

        return true;
    }

    /**
     * Determine whether the teacher can update the lesson.
     */
    public function update(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher()) {
            return TeacherAssignUser::where('teacher_id', $user->id)
                ->where('course_id', $lesson->course_id)
                ->exists();
        }

        return false;
    }

    /**
     * Determine whether the user can delete the lesson.
     */
    public function delete(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isTeacher()) {
            return TeacherAssignUser::where('teacher_id', $user->id)
                ->where('course_id', $lesson->course_id)
                ->exists();
        }

        return false;
    }
}
