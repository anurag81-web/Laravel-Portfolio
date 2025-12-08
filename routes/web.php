<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // Resource routes for admin-managed content
    Route::resource('about', AboutController::class)->except(['show']);
    Route::resource('project', \App\Http\Controllers\Admin\ProjectController::class)->except(['show']);
    Route::resource('skill', \App\Http\Controllers\Admin\SkillController::class)->except(['show']);
    Route::resource('hero', \App\Http\Controllers\Admin\HeroController::class)->only(['index','edit','update']);
    Route::resource('setting', \App\Http\Controllers\Admin\SettingController::class)->only(['index','edit','update','store']);
    
    // TODO: add resources for projects, skills, hero, settings
});
