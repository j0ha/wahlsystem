<?php

namespace App\Http\Middleware;

use App\Election;
use Closure;

class ended
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
        $electionUUID = $election->uuid;
        if($election->status != 'ended'){
            return back();
        } else {
            return $next($request);
        }


    }
}
