<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\TeacherAssignUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_view_assigned_courses()
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $assignedCourse = Course::create([
            'title' => 'Assigned French Module',
            'price' => 1200.00,
            'status' => 1,
        ]);

        TeacherAssignUser::create([
            'teacher_id' => $teacher->id,
            'user_id' => $teacher->id,
            'course_id' => $assignedCourse->id,
        ]);

        $response = $this->actingAs($teacher)->get('/teacher/courses');
        $response->assertStatus(200);
        $response->assertSee('Assigned French Module');
    }

    public function test_teacher_cannot_access_unassigned_course_lessons()
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $unassignedCourse = Course::create([
            'title' => 'Unassigned Business French',
            'price' => 3500.00,
            'status' => 1,
        ]);

        $response = $this->actingAs($teacher)->get("/teacher/courses/{$unassignedCourse->id}/lessons/create");
        $response->assertStatus(403);
    }
}
