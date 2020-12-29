<?php

namespace App\Http\Middleware;

use Closure;

class live
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
        $election = Election::where('uuid', $request->electionUUID)->firstOrFail();

        if($election->status != 'live'){
            return back()->with("Reachable at the status: live");
        }

        return $next($request);
    }
}
