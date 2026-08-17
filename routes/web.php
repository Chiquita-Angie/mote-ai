<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/meetings/{meeting}/generate-ai', [MeetingController::class, 'generateAI'])
        ->name('meetings.generate-ai');

    Route::patch('/meetings/{meeting}/update-status', [MeetingController::class, 'updateStatus'])
        ->name('meetings.update-status');

    Route::post('/meetings/{meeting}/action-items', [MeetingController::class, 'storeActionItem'])
        ->name('action-items.store');

    Route::patch('/action-items/{actionItem}/toggle-status', [MeetingController::class, 'toggleActionItemStatus'])
        ->name('action-items.toggle-status');

    Route::resource('meetings', MeetingController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';