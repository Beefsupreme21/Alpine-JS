<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    $users = User::all();

    return view('test', [
        'users' => $users, 
    ]);
});

Route::get('/x-data', function () {
    return view('methods/x-data');
});

Route::get('/x-bind', function () {
    return view('methods/x-bind');
});

Route::get('/x-on', function () {
    return view('methods/x-on');
});

Route::get('/x-text', function () {
    return view('methods/x-text');
});

Route::get('/x-html', function () {
    return view('methods/x-html');
});

Route::get('/x-model', function () {
    return view('methods/x-model');
});

Route::get('/x-show', function () {
    return view('methods/x-show');
});

Route::get('/x-transition', function () {
    return view('methods/x-transition');
});

Route::get('/x-for', function () {
    return view('methods/x-for');
});

Route::get('/x-if', function () {
    return view('methods/x-if');
});

Route::get('/x-init', function () {
    return view('methods/x-init');
});

Route::get('/x-effect', function () {
    return view('methods/x-effect');
});

Route::get('/x-ref', function () {
    return view('methods/x-ref');
});

Route::get('/x-cloak', function () {
    return view('methods/x-cloak');
});

Route::get('/x-ignore', function () {
    return view('methods/x-ignore');
});





Route::get('/dropdown', function () {
    return view('projects/dynamic-dropdown');
});

Route::get('/faq', function () {
    return view('projects/faq');
});

Route::get('/modal', function () {
    return view('projects/modal');
});

Route::get('/rating', function () {
    return view('projects/rating');
});

