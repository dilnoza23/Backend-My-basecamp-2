<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index($id, Thread $thread)
    {
        $thread = Thread::findOrFail($thread);
        $threads = Thread::all();
        $project = Project::findOrFail($id);
        if (auth()->user()->id === $project->user_id) {
            return view('threads.index', compact('project', 'threads', 'thread'));
        }

        return redirect()->back()->with('error', 'You are not authorized to create thread');
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $thread = new Thread;
        $thread->content = $request->content;
        $thread->project_id = $project->id;
        $thread->user_id = Auth::user()->id;
        $thread->save();

        return redirect()->route('projects.index');
    }

    public function edit($thread)
    {
        $thread = Thread::findOrFail($thread);
        if (auth()->user()->id === $thread->user_id) {
            return view('threads.edit', compact('thread'));
        }

        return redirect()->back()->with('error', 'You are not authorized to edit this thread');
    }

    public function update(Request $request, $thread)
    {
        $thread = Thread::findOrFail($thread);
        if (auth()->user()->id == $thread->user_id) {
            // dd($request->all());
            $validatedData = $request->validate([
                'content' => 'required|string|max:255',
            ]);

            $thread = Thread::findOrFail($thread);
            $thread->content = $request->content;
            $thread->save();

            return redirect()->route('projects.show')->with('success', 'Thread updated successfully');
        }

        return redirect()->back()->with('error', 'You are not authorized to edit this thread');
    }

    public function show($thread)
    {
        $thread = Thread::findOrFail($thread);

        return view('threads.show', compact('thread'));
    }
}