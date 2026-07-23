@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

{{-- Page Heading --}}

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
<h3 class="mb-0">Edit Subscription Plan</h3>

<nav aria-label="breadcrumb">
<ol class="breadcrumb align-items-center mb-0 lh-1">

<li class="breadcrumb-item">
<a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
<i class="ri-home-8-line fs-15 text-primary me-1"></i>
<span class="text-body fs-14 hover">Dashboard</span>
</a>
</li>

<li class="breadcrumb-item">
<a href="{{ route('admin.plans.index') }}" class="d-flex align-items-center text-decoration-none">
<i class="ri-file-list-3-line fs-15 text-primary me-1"></i>
<span class="text-body fs-14 hover">Plans</span>
</a>
</li>

<li class="breadcrumb-item active">
<span class="text-secondary">Edit Plan</span>
</li>

</ol>
</nav>
</div>

{{-- Validation Errors --}}
@if ($errors->any())

<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>
</div>
@endif

<form action="{{ route('admin.plans.update',$plan->id) }}" method="POST">
@csrf
@method('PUT')

<div class="row">

{{-- LEFT SIDE --}}

<div class="col-lg-8">

<div class="card bg-white p-20 rounded-10 border border-white mb-4">

<h3 class="mb-20">Edit Subscription Plan</h3>

{{-- Course --}}

<div class="mb-20">
<label class="label fs-16 mb-2">Course</label>

<select name="course_id" class="form-select" required>

<option value="">Select Course</option>

@foreach($courses as $course)

<option value="{{ $course->id }}"
{{ old('course_id',$plan->course_id) == $course->id ? 'selected' : '' }}>

{{ $course->title }}

</option>

@endforeach

</select>
</div>

{{-- Plan Name --}}

<div class="mb-20">

<label class="label fs-16 mb-2">Plan Name</label>

<div class="form-floating">

<input type="text"
class="form-control"
name="plan_name"
value="{{ old('plan_name',$plan->plan_name) }}"
placeholder="Plan Name">

<label>Plan Name</label>

</div>

</div>

{{-- Duration Type --}}

<div class="mb-20">

<label class="label fs-16 mb-2">Duration Type</label>

<select name="duration_type" class="form-select">

<option value="days"
{{ old('duration_type',$plan->duration_type)=='days' ? 'selected' : '' }}>
Days
</option>

<option value="months"
{{ old('duration_type',$plan->duration_type)=='months' ? 'selected' : '' }}>
Months
</option>

<option value="years"
{{ old('duration_type',$plan->duration_type)=='years' ? 'selected' : '' }}>
Years
</option>

</select>

</div>

{{-- Duration Value --}}

<div class="mb-20">

<label class="label fs-16 mb-2">Duration Value</label>

<div class="form-floating">

<input type="number"
class="form-control"
name="duration_value"
value="{{ old('duration_value',$plan->duration_value) }}"
placeholder="Duration">

<label>Duration</label>

</div>

</div>

{{-- Price --}}

<div class="mb-20">

<label class="label fs-16 mb-2">Price</label>

<div class="form-floating">

<input type="number"
step="0.01"
class="form-control"
name="price"
value="{{ old('price',$plan->price) }}"
placeholder="Price">

<label>Price</label>

</div>

</div>

</div>

</div>

{{-- RIGHT SIDE --}}

<div class="col-lg-4">

<div class="card bg-white p-20 rounded-10 border border-white mb-4">

<h3 class="mb-20">Plan Overview</h3>

{{-- Status --}}

<div class="mb-20">

<label class="label fs-16 mb-2">Status</label>

<select name="status" class="form-select">

<option value="1"
{{ old('status',$plan->status)==1 ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ old('status',$plan->status)==0 ? 'selected' : '' }}>
Inactive
</option>

</select>

</div>

{{-- Buttons --}}

<div class="d-flex justify-content-between gap-2">

<button type="submit" class="btn btn-primary fw-normal text-white">
Update Plan
</button>

<a href="{{ route('admin.plans.index') }}"
class="btn btn-outline-border-color text-secondary fw-normal">
Cancel </a>

</div>

</div>

</div>

</div>

</form>

</div>

@endsection
