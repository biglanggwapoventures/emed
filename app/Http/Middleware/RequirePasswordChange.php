<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Session;
use Route, Request, Auth;

use App\Permissions;
use App\UserRoles;
use App\CustomUser;

use EMedHelper, EMedUtil;


class RequirePasswordChange
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
        $flag = EMedHelper::requirePasswordChange();
        if($flag)
        {
            return redirect('ChangePass');
        }
        else
        {
            return $next($request);
        }
    }
}
