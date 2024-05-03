<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AttachmentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file',
            'project_id' => 'required|exists:projects,id',
        ]);

        $path = $request->file('file')->store('attachments', 'public');

        $attachment = new Attachment();
        $attachment->file_path = $path;
        $attachment->project_id = $validatedData['project_id'];
        $attachment->user_id = auth()->user()->id;
        $attachment->save();

        return redirect()->back()->with('success', 'Attachment uploaded successfully.');
    }

    public function destroy(Attachment $attachment)
    {
        if ($attachment->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        Storage::disk('public')->delete($attachment->file_path);
        $attachment->delete();

        return redirect()->back()->with('success', 'Attachment deleted successfully.');
    }

    public function download(Attachment $attachment)
    {
        $file = Storage::disk('public')->path($attachment->file_path);
        return response()->download($file, $attachment->file_name);
    }
}
