<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Member;
use Carbon\Carbon;

class CheckDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $all_members = Member::all();

        foreach($all_members as $member){
            $before_end_1_month = Carbon::parse($member->end)->submonth();

            $about_to_date = now()->diffInMonths($before_end_1_month) <= 0 && now()->diffInMonths($before_end_1_month) >= -1   ? "1" : "0" ;
            $member->about_to_date = $about_to_date;
            
            if(now() > $member->end){
                $member->status = "inactive";   
            }
            elseif(now() <= $member->end && $member->status === "blocked"){
                $member->status = "blocked";   
            }
            else {
                $member->status = "active";   
            }
            $member->save();
        }
        return $next($request);
    }
}