<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ExerciseSetController;
use App\Http\Controllers\MuscleGroupController;
use App\Http\Controllers\ProgressMetricController;
use App\Http\Controllers\WorkoutSessionController;
use App\Http\Controllers\WorkoutExerciseController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class);
    Route::resource('workouts', WorkoutController::class);
    Route::resource('equipments', EquipmentController::class);
    Route::resource('muscle-groups', MuscleGroupController::class);
    Route::resource('exercises', ExerciseController::class);
    Route::resource('workout-exercises', WorkoutExerciseController::class);
    Route::resource('workout-sessions', WorkoutSessionController::class);
    Route::resource('exercise-sets', ExerciseSetController::class);
    Route::resource('progress-metrics', ProgressMetricController::class);
    Route::resource('goals', GoalController::class);
});

require __DIR__.'/auth.php';
