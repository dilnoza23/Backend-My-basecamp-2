<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('projects', ProjectController::class);
Route::post('projects/{project}/comments', [ProjectController::class, 'storeComment'])->name('projects.storeComment');
Route::post('/projects/{project}/add-admin', [ProjectController::class, 'addAdmin'])->name('projects.addAdmin');



Route::delete('/comments/{comment}', [ProjectController::class, 'deleteComment'])->name('comments.destroy');
Route::put('/comments/{comment}', [ProjectController::class, 'updateComment'])->name('comments.update');


//thread section 
Route::get('project/{project}/thread', [ThreadController::class, 'index'])->name('threads.index');
Route::post('/project/{project}/thread', [ThreadController::class, 'store'])->name('threads.store');
Route::get('/thread/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
Route::get('/thread/{thread}/show', [ThreadController::class, 'show'])->name('threads.show ');
Route::post('/thread/{thread}/update', [ThreadController::class, 'update'])->name('threads.update');
Route::delete('/thread/{thread}/delete', [ThreadController::class, 'destroy'])->name('threads.destroy');
//message section
Route::post('thread/{thread}/message', [CommentController::class, 'store']);
Route::put('/thread/{thread}/message/{message}/update', [CommentController::class, 'update'])->name('message.update');
Route::delete('/thread/{thread}/message/{message}/delete', [CommentController::class, 'delete'])->name('message.destroy');

Route::post('/projects/{project}/attachments', [AttachmentController::class, 'store'])->name('attachments.store');
Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');
Route::get('attachments/{attachment}/download', [AttachmentController::class, 'download'])->name('attachments.download');



require __DIR__.'/auth.php';
