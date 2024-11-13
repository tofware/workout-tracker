<?php

use App\Enums\ExperienceLevel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
