<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'save')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

});

// admin only
Route::group(['middleware' => 'isAdmin','prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::delete('permissions_mass_destroy', [\App\Http\Controllers\Admin\PermissionController::class, 'massDestroy'])->name('permissions.mass_destroy');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::delete('roles_mass_destroy', [\App\Http\Controllers\Admin\RoleController::class, 'massDestroy'])->name('roles.mass_destroy');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::delete('users_mass_destroy', [\App\Http\Controllers\Admin\UserController::class, 'massDestroy'])->name('users.mass_destroy');
    
    // categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::delete('categories_mass_destroy', [\App\Http\Controllers\Admin\CategoryController::class, 'massDestroy'])->name('categories.mass_destroy');

    // questions
    Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class);
    Route::delete('questions_mass_destroy', [\App\Http\Controllers\Admin\QuestionController::class, 'massDestroy'])->name('questions.mass_destroy');

    // options
    Route::resource('options', \App\Http\Controllers\Admin\OptionController::class);
    Route::delete('options_mass_destroy', [\App\Http\Controllers\Admin\OptionController::class, 'massDestroy'])->name('options.mass_destroy');

    // results
    Route::resource('results', \App\Http\Controllers\Admin\ResultController::class);
    Route::delete('results_mass_destroy', [\App\Http\Controllers\Admin\ResultController::class, 'massDestroy'])->name('results.mass_destroy');
});


