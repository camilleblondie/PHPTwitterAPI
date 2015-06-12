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
			$results = DB::insert('INSERT INTO users (email, password, username) VALUES (?, ?, ?)',
				[ Request::input('email'),
				Hash::make(htmlspecialchars(Request::input('password'))),
				Request::input('username') ]);
		}
		if (Auth::attempt(Request::only('email', 'password'))) {
			return redirect('dashboard'); // return redirect('choose-offer')
		}
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

	public function chooseOffer()
	{
		if (strlen(Request::query('offer')) > 0) {
			if (Request::input('offer') == "gold") {
				DB::update('UPDATE users SET offer = 3 WHERE id = ?', [Auth::user()->id]);
			}
			else if (Request::input('offer') == "silver") {
				DB::update('UPDATE users SET offer = 2 WHERE id = ?', [Auth::user()->id]);
			}
			else {
				DB::update('UPDATE users SET offer = 1 WHERE id = ?', [Auth::user()->id]);
			}

			if (Request::has('change') == false) {
				DB::update('UPDATE users SET api_key = ? WHERE id = ?', [uniqid(), Auth::user()->id]);
			}
			return redirect('/dashboard');
		}
		elseif (Request::query('change') == 1) {
			return view('choose-offer'); 
		}
		else {
			return view('choose-offer');
		}
	}
}
