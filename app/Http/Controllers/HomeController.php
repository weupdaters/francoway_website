<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ContactMessage;


class HomeController extends Controller
{
    // HOME PAGE
    public function index()
    {
        $courses = Course::where('status', 'published')
                    ->latest()
                    ->take(6)
                    ->get();

        return view('index', compact('courses'));
    }

    // ALL COURSES PAGE
    public function courses()
    {
        $courses = Course::where('status', 'published')
                    ->latest()
                    ->paginate(9);

        return view('courses.index', compact('courses'));
    }

    // SINGLE COURSE PAGE
    public function show($id)
    {
        $course = Course::where('status', 'published')
                    ->findOrFail($id);

        return view('courses.show', compact('course'));
    }

    //contact page
     public function contactUs()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('contactUs', compact('settings'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:100',
        'email'   => 'required|email',
        'message' => 'required|string',
    ]);

    ContactMessage::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'message' => $request->message,
    ]);

    return back()->with('success', 'Message saved successfully!');
}


}
