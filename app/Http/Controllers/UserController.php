<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use DB;
use Request;
use Hash;
use Auth;
use Session;

class UserController extends BaseController
{
	public function getUsers()
	{
		$users = DB::select('SELECT * FROM users');
		return view('home', ['users' => $users]);
	}

	public function createUser()
	{
		if (strlen(Request::input('offer')) > 0) {
			$offer;
			if (Request::input('offer') == "gold") {
				$offer = 3;
			}
			else if (Request::input('offer') == "silver") {
				$offer = 2;
			}
			else {
				$offer = 1;
			}

			$results = DB::insert('INSERT INTO users (email, password, api_key, username, offer) VALUES (?, ?, ?, ?, ?)',
				[ Request::input('email'),
				Hash::make(htmlspecialchars(Request::input('password'))),
				uniqid(),
				Request::input('username'),
				$offer ]);
		}
		else {
			$results = DB::insert('INSERT INTO users (email, password, api_key, username) VALUES (?, ?, ?, ?)',
				[ Request::input('email'),
				Hash::make(htmlspecialchars(Request::input('password'))),
				uniqid(),
				Request::input('username') ]);
		}
		if (Auth::attempt(Request::only('email', 'password'))) {
			return redirect('dashboard'); // return redirect('choose-offer')
		}
	}

	public function loginUser()
	{
		if (Auth::attempt(Request::only('email', 'password'))) {
			$api_key = DB::select('SELECT api_key FROM users WHERE id = ?', [ Auth::user()->id ]);
			Session::put('access_token', json_decode($api_key[0]->api_key, true));
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
			Session::flush();
		}
		return redirect('/');
	}

	public static function updateAccessToken($access_token)
	{
		DB::update('UPDATE users SET api_key = ? WHERE id = ?',
				[ json_encode($access_token), Auth::user()->id ]);
	}
}
