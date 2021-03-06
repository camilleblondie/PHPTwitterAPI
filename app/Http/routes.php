<?php

use Abraham\TwitterOAuth\TwitterOAuth;



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

$app->get('/choose-offer', [
    'middleware' => 'authMiddleware',
    'uses' => 'App\Http\Controllers\UserController@chooseOffer'
]);

// Handling sign in with twitter
$app->get('/authorize', ['middleware' => 'authMiddleware', function() use ($app) {
    // callback from twitter
    if (isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier'])) {
        $request_token = [];
        $request_token['oauth_token'] = Session::get('oauth_token');
        $request_token['oauth_token_secret'] = Session::get('oauth_token_secret');
        if ($request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            // Abort! Something is wrong.
        }
        $connection = new TwitterOAuth(config('constants.CONSUMER_SECRET'), config('constants.CONSUMER_SECRET'),
            $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
        // saving access token
        User::updateAccessToken($access_token);
        return redirect(url('/dashboard'));
    } else {
        // generating request token
        $connection = new TwitterOAuth(config('constants.CONSUMER_KEY'), config('constants.CONSUMER_SECRET'));
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => url('/authorize')));
        Session::put('oauth_token', $request_token['oauth_token']);
        Session::put('oauth_token_secret', $request_token['oauth_token_secret']);
        // redirecting to twitter
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        return redirect($url);
    }
}]);

$app->group(['prefix' => 'api', 'middleware' => ['apiBeforeMiddleware', 'logMiddleware']], function () use ($app) {

    // POST /tweet
    $app->post('/tweet', function(){
        if (Request::has('status'))
        {
            $connection = Request::get('connection');
            $status = $connection->post("statuses/update", array("status" => Request::get('status')));
            if ($connection->getLastHttpCode() == 200)
                return response()->json(['id' => $status->id]);
            else
                return response()->json(['error' => 'Tweet is exceeding 140 characters']);
        }
        else
            return response()->json(['error' => 'Please specify a "status" parameter.']);
    });

    // DELETE /tweet/:id
    $app->delete('/tweet/{id}', function($id) {
        if (!is_numeric($id))
        {
            return response()->json(["error" => "The id must be a number"]);
        }
        else {
            $connection = Request::get('connection');
            $status = $connection->post("statuses/destroy/" . $id);
            if ($connection->getLastHttpCode() == 200)
                return response()->json(['id' => $status->id]);
            else
                return response()->json($status);
        }
    });

    // POST /retweet/:id
    $app->post('/retweet/{id}', function($id){
        if (!is_numeric($id))
        {
            return response()->json(["error" => "The id must be a number"]);
        }
        else {
            $connection = Request::get('connection');
            $status = $connection->post("statuses/retweet/" . $id);
            if ($connection->getLastHttpCode() == 200)
                return response()->json(['id' => $status->id]);
            else
                return response()->json(['error' => 'This tweet does not exist.']);
        }
    });

    // GET /tweet/:id
    $app->get('/tweet/{id}', function($id) {
        if (!is_numeric($id))
        {
            return response()->json(["error" => "The id must be a number"]);
        }
        else {
            $connection = Request::get('connection');
            $status = $connection->get("statuses/show", array("id" => $id));
            if ($connection->getLastHttpCode() == 200)
                return response()->json(['text' => $status->text]);
            else
                return response()->json(['error' => 'This tweet does not exist.']);
        }
    });

    // GET /tweets/:screen_name
    $app->get('/tweets/{screen_name}', function($screen_name) {
        $memcached = new Memcached();
        $memcached->addServer('localhost', 11211);

        if ($memcached->get('tweets'.$screen_name))
        {
            return response()->json($memcached->get('tweets'.$screen_name));
        }
        else {
            $connection = Request::get('connection');
            $statuses = $connection->get("statuses/user_timeline", array("screen_name" => $screen_name));
            if ($connection->getLastHttpCode() == 200) {
                $tweets = [];
                foreach ($statuses as $status)
                    array_push($tweets, ['text' => $status->text, "id" => $status->id]);
                $memcached->set('tweets'.$screen_name, $tweets, 120);
                return response()->json($tweets);
            } else
                return response()->json(['error' => 'This tweet does not exist.']);
        }
    });

    // GET /favorites
    $app->get('/favorites', function() {
        if (!Request::has('screen_name') && !Request::has('user_id'))
            return response()->json(['error' => 'This user does not exist']);
        $screen_name = Request::input('screen_name', '');
        $count = Request::input('count', '10');

        if (!is_numeric($count))
        {
            return response()->json(["error" => "The parameter count must be a number"]);
        }
        else {
            $memcached = new Memcached();
            $memcached->addServer('localhost', 11211);

            if ($memcached->get('favorites' . $screen_name . $count)) {
                return response()->json($memcached->get('favorites' . $screen_name . $count));
            } else {
                $connection = Request::get('connection');
                $user_id = Request::input('user_id', '');

                if (Request::has('screen_name'))
                    $statuses = $connection->get("favorites/list", array("screen_name" => $screen_name, "count" => $count));
                else
                    $statuses = $connection->get("favorites/list", array("user_id" => $user_id, "count" => $count));
                if ($connection->getLastHttpCode() == 200) {
                    $tweets = [];
                    foreach ($statuses as $status)
                        array_push($tweets, ['text' => $status->text, 'screen_name' => $status->user->screen_name, "id" => $status->id]);
                    $memcached->set('favorites' . $screen_name . $count, $tweets, 120);
                    return response()->json($tweets);
                } else
                    return response()->json(['error' => 'This user does not exist']);
            }
        }
    });

    // GET /followers
    $app->get('/followers', function() {
        if (!Request::has('screen_name') && !Request::has('user_id'))
            return response()->json(['error' => 'This user does not exist']);
        $screen_name = Request::input('screen_name', '');
        $count = Request::input('count', '10');
        if (!is_numeric($count))
        {
            return response()->json(["error" => "The parameter count must be a number"]);
        }
        else {
            $memcached = new Memcached();
            $memcached->addServer('localhost', 11211);

            if ($memcached->get('followers' . $screen_name . $count)) {
                return response()->json($memcached->get('followers' . $screen_name . $count));
            } else {
                $connection = Request::get('connection');
                $user_id = Request::input('user_id', '');
                if (Request::has('screen_name'))
                    $followers_list = $connection->get("followers/list", array("screen_name" => $screen_name, "count" => $count));
                else
                    $followers_list = $connection->get("followers/list", array("user_id" => $user_id, "count" => $count));
                if ($connection->getLastHttpCode() == 200) {
                    $followers = [];
                    foreach ($followers_list->users as $follower)
                        array_push($followers, ['screen_name' => $follower->screen_name]);
                    $memcached->set('followers' . $screen_name . $count, $followers, 120);
                    return response()->json($followers);
                } else
                    return response()->json(['error' => 'This user does not exist']);
            }
        }
    });

    // GET /followings
    $app->get('/followings', function() {
        if (!Request::has('screen_name') && !Request::has('user_id'))
            return response()->json(['error' => 'This user does not exist']);
        $screen_name = Request::input('screen_name', '');
        $count = Request::input('count', '10');
        if (!is_numeric($count))
        {
            return response()->json(["error" => "The parameter count must be a number"]);
        }
        else {
            $memcached = new Memcached();
            $memcached->addServer('localhost', 11211);


            if ($memcached->get('followings' . $screen_name . $count)) {
                return response()->json($memcached->get('followings' . $screen_name . $count));
            } else {
                $connection = Request::get('connection');
                $user_id = Request::input('user_id', '');
                if (Request::has('screen_name'))
                    $followings_list = $connection->get("friends/list", array("screen_name" => $screen_name, "count" => $count));
                else
                    $followings_list = $connection->get("friends/list", array("user_id" => $user_id, "count" => $count));
                if ($connection->getLastHttpCode() == 200) {
                    $followings = [];
                    foreach ($followings_list->users as $following)
                        array_push($followings, ['screen_name' => $following->screen_name]);
                    $memcached->set('followings' . $screen_name . $count, $followings, 120);
                    return response()->json($followings);
                } else
                    return response()->json(['error' => 'This user does not exist']);
            }
        }

    });

    // GET /search
    $app->get('/search', function() {
        if (!Request::has('query'))
            return response()->json(['error' => 'Please specify a "query" parameter']);
        $query = Request::input('query', '');
        $count = Request::input('count', '10');
        if (!is_numeric($count))
        {
            return response()->json(["error" => "The parameter count must be a number"]);
        }
        else {
            $memcached = new Memcached();
            $memcached->addServer('localhost', 11211);


            if ($memcached->get($query . $count)) {
                return response()->json($memcached->get($query . $count));
            } else {

                $connection = Request::get('connection');
                $statuses_list = $connection->get("search/tweets", array("q" => $query, "count" => $count));
                if ($connection->getLastHttpCode() == 200) {
                    $statuses = [];
                    foreach ($statuses_list->statuses as $status)
                        array_push($statuses, ['text' => $status->text, "id" => $status->id]);
                    $memcached->set($query . $count, $statuses, 120);
                    return response()->json($statuses);
                } else
                    return response()->json(['error' => $connection->getLastHttpCode()]);
            }
        }
    });

    // GET Not cached /search
    $app->get('/notcachedsearch', function() {
        if (!Request::has('query'))
            return response()->json(['error' => 'Please specify a "query" parameter']);

        $query = Request::input('query', '');

        $connection = Request::get('connection');
        $count = Request::input('count', '10');
        $statuses_list = $connection->get("search/tweets", array("q" => $query, "count" => $count));
        if ($connection->getLastHttpCode() == 200) {
            $statuses = [];
            foreach ($statuses_list->statuses as $status)
                array_push($statuses, ['text' => $status->text, "id" => $status->id]);
            return response()->json($statuses);
        }
        else
            return response()->json(['error' => $connection->getLastHttpCode()]);
    });
});