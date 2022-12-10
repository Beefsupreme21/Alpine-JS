<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/x-data', function () {
    return view('x-data');
});

Route::get('/x-show', function () {
    return view('methods/x-show');
});



Route::get('/faq', function () {
    return view('faq');
});

Route::get('/rating', function () {
    return view('rating');
});