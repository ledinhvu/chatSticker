<?php namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\RedirectResponse;
use Auth;

class Admin {
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
            if(Auth::user()->role==1) {
                return $next($request);
            } else {
                Auth::logout();
                return new RedirectResponse(url('/loginChat'));
            }
			
		} else {
			return new RedirectResponse(url('/loginChat'));
		}
	}
}