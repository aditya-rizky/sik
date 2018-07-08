<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class role_sekretariat
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
        $level = Auth::user()->id_role;
        if ($level == '2' || $level == '1') {
            return $next($request);   
        }else{
            return redirect('/forbidden');
        }
    }
}
