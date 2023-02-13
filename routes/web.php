<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    $users = User::all();

    return view('test', [
        'users' => $users, 
    ]);
});

Route::resource('/users', UserController::class);

Route::get('/directives/x-data', function () {
    return view('methods.x-data');
});

Route::get('/directives/x-bind', function () {
    return view('methods.x-bind');
});

Route::get('/directives/x-on', function () {
    return view('methods.x-on');
});

Route::get('/directives/x-text', function () {
    return view('methods.x-text');
});

Route::get('/directives/x-html', function () {
    return view('methods.x-html');
});

Route::get('/directives/x-model', function () {
    return view('methods.x-model');
});

Route::get('/directives/x-show', function () {
    return view('methods.x-show');
});

Route::get('/directives/x-transition', function () {
    return view('methods.x-transition');
});

Route::get('/directives/x-for', function () {
    return view('methods.x-for');
});

Route::get('/directives/x-if', function () {
    return view('methods.x-if');
});

Route::get('/directives/x-init', function () {
    return view('methods.x-init');
});

Route::get('/directives/x-effect', function () {
    return view('methods.x-effect');
});

Route::get('/directives/x-ref', function () {
    return view('methods/x-ref');
});

Route::get('/directives/x-cloak', function () {
    return view('methods/x-cloak');
});

Route::get('/directives/x-ignore', function () {
    return view('methods/x-ignore');
});





Route::get('/projects', function () {
    return view('home');
});

Route::get('projects/calculator', function () {
    return view('projects/calculator');
});

Route::get('projects/dropdown', function () {
    return view('projects/dynamic-dropdown');
});

Route::get('projects/expense-tracker', function () {
    return view('projects/expense-tracker');
});

Route::get('projects/faq', function () {
    return view('projects/faq');
});

Route::get('projects/modal', function () {
    return view('projects/modal');
});

Route::get('projects/rating', function () {
    return view('projects/rating');
});

Route::get('projects/sort', function () {
    $users = User::all();
    
    return view('projects/sort', [
        'users' => $users, 
    ]);
});

Route::get('projects/todo-list', function () {
    return view('projects/todo-list');
});

Route::get('projects/weather', function () {
    return view('projects/weather');
});