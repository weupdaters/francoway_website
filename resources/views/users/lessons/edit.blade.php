@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Lesson</h2>

    <form action="{{ route('admin.lessons.update',$lesson->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Course</label>
            <select name="course_id" class="form-control">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}"
                        {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Lesson Title</label>
            <input type="text" name="title" class="form-control" value="{{ $lesson->title }}">
        </div>

        <div class="mb-3">
            <label>Video URL</label>
            <input type="text" name="video_url" class="form-control" value="{{ $lesson->video_url }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $lesson->description }}</textarea>
        </div>

        <button class="btn btn-primary">Update Lesson</button>
    </form>
</div>
@endsection
