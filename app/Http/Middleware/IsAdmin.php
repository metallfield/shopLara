<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if($user->role !== 'admin'){
            session()->flash('warning', "you have not permission");
            return redirect()->route('home');
        }
        session()->flash('success', 'hello admin');
        return $next($request);
    }
}
