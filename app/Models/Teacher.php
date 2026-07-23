<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'phone', 'address'];
    
public function users()
{
    return $this->belongsToMany(User::class, 'teacher_user');
}

public function courses()
{
    return $this->belongsToMany(Course::class, 'teacher_user');
}
public function teacherAssignUsers()
{
    return $this->hasMany(TeacherAssignUser::class, 'teacher_id', 'user_id');
}
public function getCoursesAttribute()
{
    return $this->courses()->pluck('title')->implode(', ');
}


     
}


