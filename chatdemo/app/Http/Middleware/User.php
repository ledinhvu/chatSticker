<?php namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\RedirectResponse;
use Auth;

class User {
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
            return $next($request);
		} else {
			return new RedirectResponse(url('/loginChat'));
		}
	}
}