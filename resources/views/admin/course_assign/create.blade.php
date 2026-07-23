@extends('admin.layouts.app')

@section('content')

<div class="main-content-container overflow-hidden">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Assign Course</h3>
</div>

<form action="{{ route('admin.course-assign.store') }}" method="POST">
@csrf

<div class="row">

<div class="col-lg-8">

<div class="card bg-white p-20 rounded-10 border border-white mb-4">

{{-- Course --}}
<div class="mb-20">

<label class="label fs-16 mb-2">Select Course</label>

<select name="course_id" class="form-select" required>

<option value="">Select Course</option>

@foreach($courses as $course)

<option value="{{ $course->id }}">
{{ $course->title }}
</option>

@endforeach

</select>

</div>


{{-- User --}}
<div class="mb-20">

<label class="label fs-16 mb-2">Select User</label>

<select name="user_id" class="form-select" required>

<option value="">Select User</option>

@foreach($users as $user)

<option value="{{ $user->id }}">
{{ $user->name }} ({{ $user->email }})
</option>

@endforeach

</select>

</div>


{{-- Course Type --}}
<div class="mb-20">

<label class="label fs-16 mb-2">Course Type</label>

<select name="course_type" id="course_type" class="form-select">

<option value="free">Free</option>

<option value="paid">Paid</option>

</select>

</div>


{{-- Price --}}
<div class="mb-20 paidFields" style="display:none;">

<label class="label fs-16 mb-2">Price</label>

<input type="number"
name="price"
class="form-control"
placeholder="Enter price">

</div>


{{-- Duration --}}
<div class="mb-20 paidFields" style="display:none;">

<label class="label fs-16 mb-2">Duration</label>

<div class="row">

<div class="col-md-6">

<input type="number"
name="duration_value"
class="form-control"
placeholder="Duration">

</div>

<div class="col-md-6">

<select name="duration_type" class="form-select">

<option value="days">Days</option>
<option value="weeks">Weeks</option>


<option value="months">Months</option>

<option value="years">Years</option>

</select>

</div>

</div>

</div>


{{-- Status --}}
<div class="mb-20">

<label class="label fs-16 mb-2">Status</label>

<select name="status" class="form-select">

<option value="1">Published</option>

<option value="0">Draft</option>

</select>

</div>


</div>
</div>


<div class="col-lg-4">

<div class="card bg-white p-20 rounded-10 border border-white">

<button class="btn btn-primary w-100 text-white">
Assign Course
</button>

</div>

</div>


</div>

</form>

</div>

@endsection


@push('scripts')

<script>

$(document).ready(function(){

$('#course_type').change(function(){

let type = $(this).val();

if(type === 'paid'){

$('.paidFields').show();

}else{

$('.paidFields').hide();

}

});

});

</script>

@endpush