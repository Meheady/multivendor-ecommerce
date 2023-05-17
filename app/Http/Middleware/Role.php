<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::check()){
            $expTime = Carbon::now()->addSeconds(30);
            Cache::put('user-online'.Auth::user()->id,true,$expTime);
            User::where('id',Auth::user()->id)->update(['last_seen'=>Carbon::now()]);
        }
        if (Auth::user()->role !== $role){
            return redirect()->back();
        }
        return $next($request);
    }
}
