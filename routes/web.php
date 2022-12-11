<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/x-data', function () {
    return view('methods/x-data');
});

Route::get('/x-show', function () {
    return view('methods/x-show');
});

Route::get('/x-text', function () {
    return view('methods/x-text');
});


Route::get('/faq', function () {
    return view('projects/faq');
});

Route::get('/rating', function () {
    return view('projects/rating');
});