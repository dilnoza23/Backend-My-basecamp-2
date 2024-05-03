<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        // $admins = Admins::all();
        return view('dashboard', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);


        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = auth()->user()->id;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $users = User::all();
        $admins = Admins::all();

        return view('projects.edit', compact('project', 'users', 'admins'));
    }


    public function addAdmin(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the selected user exists
        ]);

        // Check if the authenticated user is the admin of the project
        if ($project->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        // Check if the user is already an admin of the project
        if ($project->admins()->where('user_id', $validatedData['user_id'])->exists()) {
            return redirect()->back()->with('error', 'This user is already an admin of the project.');
        }

        // Add the user as an admin to the project
        $admin = new Admins();
        $admin->project_id = $project->id;
        $admin->user_id = $validatedData['user_id'];
        $admin->save();

        return redirect()->back()->with('success', 'Admin added successfully.');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($project->user_id == Auth::user()->id) {
            $project->update($request->only(['name', 'description']));
        }


        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }





    public function show($id)
    {
        $project = Project::findOrFail($id);
        $attachments = Attachment::where('project_id', $id)->get(); // Retrieve attachments for the project
        $users = User::all();

        return view('projects.index', compact('project', 'attachments', 'users'));
    }

    public function destroy(Project $project)
    {

        if ($project->user_id == Auth::user()->id) {
            $project->delete();
        }

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function editComment(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function updateComment(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function storeComment(Request $request, Project $project)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->project_id = $project->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
