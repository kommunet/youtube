<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		$allow_user = match(true)
		{
			// Is it directly stated in the .env that the site is under maintenance?
			// TO-DO: Make a means to do this directly from the site, and allow some sort of whitelist
			!env("YOUTUBE_DOWNTIME") => true,
			
			// Otherwise, don't let them in
			default => false,
		};
		
		if(!$allow_user)
			return response()->view("maintenance");
		
        return $next($request);
    }
}
