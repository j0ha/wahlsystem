<?php

namespace App\Http\Middleware;

use App\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Spatie\Permission\Models\Role;

class AdminRole
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
        $user = Auth::user();

        $role = Role::where('name', 'admin')->first();

        if(empty($role)) {
            Role::create(['name' => 'admin']);
        }

        if($user->hasRole('admin')){

            return $next($request);
        }
        return back();

    }
}
