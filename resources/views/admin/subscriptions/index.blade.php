
@extends('admin.layouts.app')

@section('content')

<div class="container">

<h3>Subscriptions</h3>

@include('admin.includes.alerts')

@if(count($subs) > 0)

@endif
        
<table class="table">

<tr>
<th>User</th>
<th>Course</th>
<th>Plan</th>
<th>Start</th>
<th>Expiry</th>
</tr>

@foreach($subs as $sub)

<tr>

<td>{{ $sub->user->name }}</td>

<td>{{ $sub->course->title }}</td>

<td>{{ $sub->plan->plan_name }}</td>

<td>{{ $sub->start_date }}</td>

<td>{{ $sub->expiry_date }}</td>

</tr>

@endforeach

</table>