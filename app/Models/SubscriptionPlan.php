<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{

protected $fillable = [
'course_id',
'plan_name',
'duration_type',
'duration_value',
'price',
'status'
];

public function course()
{
return $this->belongsTo(Course::class);
}

}