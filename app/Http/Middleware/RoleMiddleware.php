<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RoleMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		foreach (App\Role::all() as $role) {
			if ($role->name == Auth::user()->role->name) {
				return $next($request);
			}
		}
		return back();
	}
}
