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
        $user = User::whereEmail($request->cemail)->first();
        if ($user) {

            return redirect('login')->with('error', 'User Already Exist');

        }
        return $next($request);
    }
}
