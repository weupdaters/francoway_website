<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'status',
        'expiry_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
}

    public function payments()
    {
        return $this->hasMany(Payment::class, 'assignment_id');
    }
}