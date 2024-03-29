<?php

use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    return view('test');
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


Route::get('games', function () {
    return view('home');
});

Route::get('games/blackjack', function () {
    return view('games/blackjack');
});

Route::get('games/candyland', function () {
    return view('games/candyland');
});

Route::get('games/hangman', function () {
    return view('games/hangman');
});

Route::get('games/horse-racing', function () {
    return view('games/horse-racing');
});

Route::get('games/pokemon-quiz', function () {
    return view('games/pokemon-quiz');
});

Route::get('games/quiz', function () {
    return view('games/quiz');
});

Route::get('games/quiz-with-database', function () {
    $questions = Question::with('answers')->get();

    return view('games/quiz-with-database', [
        'questions' => $questions, 
    ]);
});

Route::get('games/war', function () {
    return view('games/war');
});

Route::get('games/wheel-of-fortune', function () {
    return view('games/wheel-of-fortune');
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

Route::get('projects/memory', function () {
    return view('projects/memory');
});

Route::get('projects/modal', function () {
    return view('projects/modal');
});

Route::get('projects/pokemon-list', function () {
    return view('projects/pokemon-list');
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

