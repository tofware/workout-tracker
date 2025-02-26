<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ExerciseSetController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProgressMetricController;
use App\Http\Controllers\WorkoutSessionController;

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

    Route::resource('workouts', WorkoutController::class);
    Route::resource('progress-metrics', ProgressMetricController::class);
    Route::resource('goals', GoalController::class);

    Route::get('workouts/{workout}/exercises', [WorkoutController::class, 'getExercises'])->name('workouts.get-exercises');
    Route::post('workouts/{workout}/exercises/{exercise}', [WorkoutController::class, 'addExercise'])->name('workouts.add-exercises');
    Route::delete('workouts/{workout}/exercises/{exercise}', [WorkoutController::class, 'removeExercise'])->name('workouts.remove-exercises');

    Route::prefix('workout-sessions')->controller(WorkoutSessionController::class)->group(function () {
        Route::get('create', 'create')->name('workout-sessions.create');
        Route::post('/', 'store')->name('workout-sessions.store');
        Route::get('start/{workoutSession}', 'start')->name('workout-sessions.start');
        Route::get('finish/{workoutSession}', 'finish')->name('workout-sessions.finish');
    });

    Route::post('/exercise-sets', [ExerciseSetController::class, 'store'])->name('exercise-sets.store');
});

require __DIR__.'/auth.php';
