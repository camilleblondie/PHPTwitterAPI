<?php namespace App\Http\Middleware;


use Abraham\TwitterOAuth\TwitterOAuth;
use Closure;
use DB;
use Request;

class ApiBeforeMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // api_key validation
        if (is_null($request->input('api_key')))
            return response()->json(['error' => 'Please specify an API key']);
        if ($request->input('api_key') != '557ae48f0a289')
        {
            $result = DB::select('SELECT consumer_key, secret_key FROM users WHERE api_key = ?', [ $request->input('api_key') ]);
            if (empty($result))
                return response()->json(['error' => 'API Key is invalid']);
            else if (is_null($result[0]->consumer_key) || is_null($result[0]->secret_key))
                return response()->json(['error' => 'Please sign in with Twitter before using the API']);

            // consumption limit
            $count = DB::select('SELECT count(*) as count FROM metrics WHERE user_id = (SELECT id FROM users WHERE api_key = ?)
                        AND date >= CAST(CURDATE() as DATETIME) AND date < CAST(CURDATE() as DATETIME) + INTERVAL 1 DAY ',
                        [ $request->input('api_key') ]);
            $offer = DB::select('SELECT offer FROM users WHERE api_key = ?',
                        [ $request->input('api_key') ]);
            if ($offer[0]->offer == '1' && $count[0]->count > 100
                || $offer[0]->offer == '2' && $count[0]->count > 600
                || $offer[0]->offer == '3' && $count[0]->count > 1200)
                return response()->json(['error' => 'API limit exceeded']);
        }
        else
            $result = [(object)array('consumer_key' =>  NULL, 'secret_key' => NULL)];

        // building connection
        $connection = new TwitterOAuth(config('constants.CONSUMER_KEY'),config('constants.CONSUMER_SECRET'), $result[0]->consumer_key, $result[0]->secret_key); 
        Request::merge(['connection' => $connection]);
        return $next($request);
    }

}
