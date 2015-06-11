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
        /*DB::select('SELECT count(*) FROM metrics WHERE user_id = :user_id
                    AND date >= CAST(CURDATE() as DATETIME) AND date <= CAST(CURDATE() as DATETIME) + INTERVAL 1 DAY ',
                    ['user_id' => Auth::user()->id]);*/

        $result = DB::select('SELECT consumer_key, secret_key FROM users WHERE api_key = ?',
                [ $request->input('api_key') ]);
        if (empty($result))
            return response()->json(['error' => 'API Key is invalid']);
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $result[0]->consumer_key, $result[0]->secret_key); 
        Request::merge(['connection' => $connection]);
        return $next($request);
    }

}
