<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use DB;
use Request;
use Hash;
use Auth;

class UserController extends BaseController
{
    public function getUsers()
    {
    	$users = DB::select('SELECT * FROM users');
        return view('home', ['users' => $users]);
    }

    public function createUser()
    {
    	$results = DB::insert('INSERT INTO users (email, password, api_key) VALUES (?, ?, ?)',
    		[ Request::input('email'),
    		Hash::make(htmlspecialchars(Request::input('password'))),
    		uniqid() ]);
        return redirect('dashboard'); // return redirect('choose-offer')
    }

    public function loginUser()
    {
    	if (Auth::attempt(Request::only('email', 'password'))) {
        	return redirect('dashboard');
    	}
    	else {
    		return redirect('login')->with('message', 'Login Failed');
    	}
    }

    public function logoutUser()
    {
    	if (Auth::check()) {
    		Auth::logout();
        	return redirect('/');
    	}
    }
}
