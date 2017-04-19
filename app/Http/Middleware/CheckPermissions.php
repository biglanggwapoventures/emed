<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Session;
use Route, Request;

use App\Permissions;

class CheckPermissions
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
        $response = $next($request);

        // $permissions = Permissions::retrieveRolePermissions();
        $currentRoute = Route::currentRouteName();
        $data = Permissions::hasUrlPermission($currentRoute);

        Log::info('Route accessed:' . $currentRoute);

        $continue = !is_null($data);

        // foreach ($permissions as $permission) 
        // {
        //     if($currentRoute === $permission->route)
        //     {
        //         $continue = true;
        //         break;
        //     }
        // } 

        if($continue)
        {
            // return $next($request);
            return $response;
        }
        else
        {
            Log::error('ACCESS DENIED. User tries to access Route=' . $currentRoute . ' but is not included in the current user\'s list of permissions.');
            abort(503);
        }
    }
}
