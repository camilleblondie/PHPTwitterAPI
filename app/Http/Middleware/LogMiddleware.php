<?php namespace App\Http\Middleware;


use Abraham\TwitterOAuth\TwitterOAuth;
use Closure;
use DB;
use Request;

class LogMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $results = DB::insert('INSERT INTO metrics (http_method, http_route, date, user_id) VALUES (?, ?, NOW(),
                        (SELECT id FROM users WHERE api_key = ?))',
                [ $request->method(), $request->path(), Request::get('api_key') ]);

        return $response;
    }

}
