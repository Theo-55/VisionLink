<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PointController;

Route::get('/', function () {
    return Inertia::render('Index', [
        'imageURL' => asset('build/assets/images/VisionLink.jpeg')
    ]);
});

Route::group(['prefix' => 'points'], function () {
    Route::get('/index', [PointController::class, 'index']);
    Route::get('/create', [PointController::class, 'create']);
    Route::post('/save', [PointController::class, 'store']);
    Route::get('/show/{id}', [PointController::class, 'edit']);
    Route::delete('/delete/{id}', [PointController::class, 'destroy']);
    Route::put('/update', [PointController::class, 'update']);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
