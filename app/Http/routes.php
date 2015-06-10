<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return view('home');
});

$app->get('/signup', function() use ($app) {
    return view('sign-up');
});
$app->post('/signup', 'App\Http\Controllers\UserController@createUser');

$app->get('/dashboard', ['middleware' => 'authMiddleware', function() use ($app) {
    return view('dashboard');
}]);

$app->get('/docs', function() use ($app) {
    return view('docs');
});


$app->get('/login', function() use ($app) {
    return view('log-in');
});
$app->post('/login', 'App\Http\Controllers\UserController@loginUser');

$app->get('/logout', 'App\Http\Controllers\UserController@logoutUser');
