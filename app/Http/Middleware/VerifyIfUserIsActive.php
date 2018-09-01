<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class VerifyIfUserIsActive
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
        if((boolean)Auth::user()->activate == false)
            return redirect()->route('profiles.edit', ['id' => Auth::user()->id]);

        return $next($request);
    }
}
