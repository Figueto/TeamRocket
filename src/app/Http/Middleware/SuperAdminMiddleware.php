<?php

/*
*   Check if user is a super admin
*/



namespace App\Http\Middleware;
use Auth;
use Closure;
use Exception;
use App\Utilisateur;

class SuperAdminMiddleware
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!$user = $request->auth){
            return response()->json([
                'error' => 'You are not logged in'
            ], 401); 
        }

        if($user->idNiveau === 1)
            return $next($request);
        else{
            return response()->json([
                'error' => 'You are not authorised to be there'
            ], 403);
        }
    }
}
