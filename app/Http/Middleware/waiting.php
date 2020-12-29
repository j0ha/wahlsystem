<?php

namespace App\Http\Middleware;

use Closure;
use App\Election;

class waiting
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

        if($election->status != 'waiting'){
            return back();
        }

        return $next($request);
    }
}
