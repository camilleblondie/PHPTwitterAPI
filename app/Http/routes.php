<?php

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\RedirectResponse;

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

$app->get('/dashboard', function() use ($app) {
    return view('dashboard');
});

$app->get('/docs', function() use ($app) {
    return view('docs');
});

// Handling sign in with twitter
$app->get('/authorize', function() use ($app) {
    session_start();
    // callback from twitter
    if (isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier'])) {
        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
        if ($request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            // Abort! Something is wrong.
        }
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
        // saving access token
        $_SESSION['access_token'] = $access_token;
        // testing
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials");
        return response()->json($user);
    } else {
        // generating request token
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => url('/authorize')));
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        // building twitter authorize url
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        return redirect($url);
    }
});

// GET /tweet/:id
$app->get('/tweet/{id}', function($id) {
    session_start();
    if (isset($_SESSION['access_token']))
    {
        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $status = $connection->get("statuses/show", array("id" => $id));
        if ($connection->getLastHttpCode() == 200)
            return response()->json(['text' => $status->text]);
        else
            return response()->json(['error' => 'This tweet does not exist.']);     
    }
    return redirect(url('/'));
});