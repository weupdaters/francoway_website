<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store new comment or reply
     */
    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
            'comment' => 'required|string'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'lesson_id' => $request->lesson_id,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id ?? null,
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }

    /**
     * Update comment or reply
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $comment = Comment::findOrFail($id);

        $user = auth()->user();
        if ($comment->user_id !== $user->id && !in_array($user->role ?? '', ['teacher', 'admin'])) {
            return back()->with('error', 'Unauthorized action.');
        }

        $comment->update([
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Comment updated successfully.');
    }

    /**
     * Delete comment or reply
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $user = auth()->user();
        if ($comment->user_id !== $user->id && !in_array($user->role ?? '', ['teacher', 'admin'])) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Delete child replies
        $comment->replies()->delete();
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}
