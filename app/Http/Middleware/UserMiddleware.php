<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::User();
            if ($user->role != 'user') {
                Session::flash('error_msg','Access Denied!.....Login First');
                return redirect('/');
            }
        } else{
            return redirect('/login');
        }
        return $next($request);
    }
}
