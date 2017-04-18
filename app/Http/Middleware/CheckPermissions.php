<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Session;
use Route;

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
        $roleId = session('user_type_id');
        $permissions = Permissions::retrieveRolePermissions($roleId);
        $currentRoute = Route::currentRouteName();

        Log::info($currentRoute);
        Log::info($request);

        $continue = false;

        foreach ($permissions as $permission) 
        {
            if($currentRoute === $permission->route)
            {
                $continue = true;
                break;
            }
        }        

        if($continue)
        {
            return $next($request);
        }
        else
        {
            Log::error('ACCESS DENIED. User tries to access Route=' . $currentRoute . ' but is not included in the current user\'s list of permissions.');
            abort(503);
        }
    }
}
