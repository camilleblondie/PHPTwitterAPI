<?php

use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));

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


// Handling sign in with twitter
$app->get('/authorize', function() use ($app) {
    // callback from twitter
    if (isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier'])) {
        $request_token = [];
        $request_token['oauth_token'] = Session::get('oauth_token');
        $request_token['oauth_token_secret'] = Session::get('oauth_token_secret');
        if ($request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            // Abort! Something is wrong.
        }
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
            $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
        // saving access token
        Session::put('access_token', $access_token);
        User::updateAccessToken($access_token);
        return redirect(url('/dashboard'));
    } else {
        // generating request token
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => url('/authorize')));
        Session::put('oauth_token', $request_token['oauth_token']);
        Session:put('oauth_token_secret', $request_token['oauth_token_secret']);
        // redirecting to twitter
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        return redirect($url);
    }
});

// GET /tweet/:id
$app->get('/tweet/{id}', function($id) {
    if (Session::has('access_token'))
    {
        $access_token = Session::get('access_token');
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $status = $connection->get("statuses/show", array("id" => $id));
        if ($connection->getLastHttpCode() == 200)
            return response()->json(['text' => $status->text]);
        else
            return response()->json(['error' => 'This tweet does not exist.']);
    }
    return redirect(url('/'));
});

// GET /tweets/:screen_name
$app->get('/tweets/{screen_name}', function($screen_name) {
    if (Session::has('access_token'))
    {
        $access_token = Session::get('access_token');
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $statuses = $connection->get("statuses/user_timeline", array("screen_name" => $screen_name));
        if ($connection->getLastHttpCode() == 200) {
            $tweets = [];
            foreach ($statuses as $status)
                array_push($tweets, ['text' => $status->text]);
            return response()->json($tweets);
        }
        else
            return response()->json(['error' => 'This tweet does not exist.']);     
    }
    return redirect(url('/'));
});

// GET /favorites
$app->get('/favorites', function() {
    if (Session::has('access_token'))
    {
        if (!Request::has('screen_name') && !Request::has('user_id'))
            return response()->json(['error' => 'This user does not exist']);
        $access_token = Session::get('access_token');
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $screen_name = Request::input('screen_name', '');
        $user_id = Request::input('user_id', '');
        $count = Request::input('count', '10');
        if (Request::has('screen_name'))
            $statuses = $connection->get("favorites/list", array("screen_name" => $screen_name, "count" => $count));
        else
            $statuses = $connection->get("favorites/list", array("user_id" => $user_id, "count" => $count));
        if ($connection->getLastHttpCode() == 200) {
            $tweets = [];
            foreach ($statuses as $status)
                array_push($tweets, ['text' => $status->text, 'screen_name' => $status->user->screen_name]);
            return response()->json($tweets);
        }
        else
            return response()->json(['error' => 'This user does not exist']);
    }
    return redirect(url('/'));
});

// GET /followers
$app->get('/followers', function() {
    if (Session::has('access_token'))
    {
        if (!Request::has('screen_name') && !Request::has('user_id'))
            return response()->json(['error' => 'This user does not exist']);
        $access_token = Session::get('access_token');
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $screen_name = Request::input('screen_name', '');
        $user_id = Request::input('user_id', '');
        $count = Request::input('count', '10');
        if (Request::has('screen_name'))
            $followers_list = $connection->get("followers/list", array("screen_name" => $screen_name, "count" => $count));
        else
            $followers_list = $connection->get("followers/list", array("user_id" => $user_id, "count" => $count));
        if ($connection->getLastHttpCode() == 200) {
            $followers = [];
            foreach ($followers_list->users as $follower)
                array_push($followers, ['screen_name' => $follower->screen_name]);
            return response()->json($followers);
        }
        else
            return response()->json(['error' => 'This user does not exist']);
    }
    return redirect(url('/'));
});

// GET /followings
$app->get('/followings', function() {
    if (Session::has('access_token'))
    {
        if (!Request::has('screen_name') && !Request::has('user_id'))
            return response()->json(['error' => 'This user does not exist']);
        $access_token = Session::get('access_token');
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $screen_name = Request::input('screen_name', '');
        $user_id = Request::input('user_id', '');
        $count = Request::input('count', '10');
        if (Request::has('screen_name'))
            $followings_list = $connection->get("friends/list", array("screen_name" => $screen_name, "count" => $count));
        else
            $followings_list = $connection->get("friends/list", array("user_id" => $user_id, "count" => $count));
        if ($connection->getLastHttpCode() == 200) {
            $followings = [];
            foreach ($followings_list->users as $following)
                array_push($followings, ['screen_name' => $following->screen_name]);
            return response()->json($followings);
        }
        else
            return response()->json(['error' => 'This user does not exist']);
    }
    return redirect(url('/'));
});