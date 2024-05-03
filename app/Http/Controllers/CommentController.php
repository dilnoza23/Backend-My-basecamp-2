<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->thread_id = $thread->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->back()->with('success', 'Message added successfully.');
    }

    public function update(Request $request, $thread, $message)
    {
        $message = Comment::findOrFail($message);

        if (auth()->user()->id === $message->user_id) {
            $request->validate([
                'content' => 'required',
            ]);

            $message->content = $request->content;
            $message->save();

            return redirect()->back()->with('success', 'Message updated successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to edit this message');
    }

    public function delete($thread, $message)
    {
        if (auth()->user()->id === $message->user_id) {
            $message = Comment::findOrFail($message);
            $message->delete();

            return redirect()->back()->with('success', 'Message deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to edit this message');
    }
}