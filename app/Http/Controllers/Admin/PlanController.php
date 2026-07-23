<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\Course;
use Illuminate\Http\Request;

class PlanController extends Controller
{

public function index(Request $request)
{
    $search = $request->query('search');
    $query = SubscriptionPlan::with('course')->latest();
    
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('plan_name', 'like', "%{$search}%")
              ->orWhere('duration_type', 'like', "%{$search}%")
              ->orWhere('price', 'like', "%{$search}%");
        });
    }
    
    $plans = $query->paginate(10)->withQueryString();

    return view('admin.plans.index',compact('plans'));
}


public function create()
{
    $courses = Course::all();

    return view('admin.plans.create',compact('courses'));
}


public function store(Request $request)
{

$request->validate([

'course_id' => 'required',
'plan_name' => 'required|string|max:50',
'duration_type' => 'required',
'duration_value' => 'required|integer',
'price' => 'required|numeric',
'status' => 'required'

]);

SubscriptionPlan::create([

'course_id' => $request->course_id,
'plan_name' => $request->plan_name,
'duration_type' => $request->duration_type,
'duration_value' => $request->duration_value,
'price' => $request->price,
'status' => $request->status

]);

return redirect()->route('admin.plans.index')
       ->with('success','Plan Created Successfully');

}


public function edit($id)
{

$plan = SubscriptionPlan::findOrFail($id);

$courses = Course::all();

return view('admin.plans.edit',compact('plan','courses'));

}


public function update(Request $request,$id)
{

$request->validate([

'course_id' => 'required',
'plan_name' => 'required|string|max:50',
'duration_type' => 'required',
'duration_value' => 'required|integer',
'price' => 'required|numeric',
'status' => 'required'

]);

$plan = SubscriptionPlan::findOrFail($id);

$plan->update([

'course_id' => $request->course_id,
'plan_name' => $request->plan_name,
'duration_type' => $request->duration_type,
'duration_value' => $request->duration_value,
'price' => $request->price,
'status' => $request->status

]);

return redirect()->route('admin.plans.index')
       ->with('success','Plan Updated Successfully');

}


public function destroy($id)
{

SubscriptionPlan::destroy($id);

return redirect()->back()
       ->with('success','Plan Deleted');

}

}