<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'lesson_id' => $request->lesson_id,
            'comment' => $request->comment,
        ]);

        return back();
    }
}
