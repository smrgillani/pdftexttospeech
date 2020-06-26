<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class IsExist
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
        
        $user=User::where('email',$request->email)->where('status','1')->whereNull('name')->whereNull('password')->first();
        
        if (empty($user)) {
            return redirect('/login')->with('error', 'User Not Exists');
        }

        return $next($request);
        
    }
}
