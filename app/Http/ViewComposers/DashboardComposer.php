<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
//use Illuminate\Users\Repository as UserRepository;
use DB;
use Auth;

class DashboardComposer {

    protected $metricsForTodayCount;
    protected $metricsCountGroupedByDay;
    protected $metricsGroupedByDay;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->metricsForTodayCount = DB::select('SELECT * FROM metrics WHERE user_id = :user_id AND date >= CAST(CURDATE() as DATETIME) AND date <= CAST(CURDATE() as DATETIME) + INTERVAL 1 DAY ', ['user_id' => Auth::user()->id]);
        $this->metricsCountGroupedByDay = DB::select('SELECT DATE_FORMAT(date,\'%d/%m/%Y\') AS date, COUNT(*) AS total FROM metrics WHERE user_id = :user_id GROUP BY DAY(date) ORDER BY date DESC', ['user_id' => Auth::user()->id]);
        $this->metricsGroupedByDay = DB::select('SELECT DATE_FORMAT(date,\'%d/%m/%Y\') AS date, http_method, http_route FROM metrics WHERE user_id = :user_id ORDER BY date DESC', ['user_id' => Auth::user()->id]);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('metricsForTodayCount', count($this->metricsForTodayCount));
        $view->with('metricsCountGroupedByDay', $this->metricsCountGroupedByDay);
        $view->with('metricsGroupedByDay', $this->metricsGroupedByDay);
    }

}