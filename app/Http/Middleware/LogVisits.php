<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \Shetabit\Visitor\Models\Visit;
use Carbon\Carbon;

class LogVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $logHasSaved = false;

        // create log for first binded model
        foreach ($request->route()->parameters() as $parameter) {
            if ($parameter instanceof Model) {
                visitor()->visit($parameter);

                $logHasSaved = true;

                break;
            }
        }
        //check last visit 1 hour
        $lastVisit = visit::orderByDesc('id')->first();
        if(isset($lastVisit)){
            //echo visitor()->url();
            $url = $lastVisit->url;
            $referer = $lastVisit->referer;
            //echo $request->visitor()->url();
            $lasthit = $lastVisit->created_at;
            $ipaddr = $lastVisit->ip;
            $useragent = $lastVisit->useragent;

            $startTime = Carbon::parse($lasthit);
            $endTime = Carbon::now();
            $totalDuration = $endTime->diffInMinutes($startTime);
            
            if( (in_array(visitor()->url(), [$url, $referer])) || (visitor()->referer() != null) ){
                //jangan disave
                if(($totalDuration < 60) ){
                    $logHasSaved = true;    
                }
            }
        }

        // create log for normal visits
        if (!$logHasSaved) {
            visitor()->visit();    
        }

        return $next($request);
    }
}
