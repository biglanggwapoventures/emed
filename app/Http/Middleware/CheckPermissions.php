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
        $currentRoute = Route::currentRouteName();

        if(is_null($currentRoute) || trim($currentRoute) === "")
        {
            $requestPath = Request::path();
            Log::error("Aborting to 404. User with type [" . session('user_type_name') . "] tried to access an unregistered path [" . $requestPath . "]. If this should not be the case, counter-check the permissions and the route names.");
           
            abort(404);
        }
        else
        {
            $routeData = EMedUtil::extractRouteData($currentRoute);
            $target = $routeData->target;
            $action = EMedUtil::recreateRouteAction($routeData->action);

            $route = $target.".".$action;
            $permission = Permissions::retrieveByRoute($route);

            if(EMedUtil::isInvalid($permission))
            {
                $msg = 'ACCESS DENIED. User tries to access Route=' . $currentRoute . ' but is not included in the current user\'s list of permissions.';

                Session::flash('503_msg', $msg);
                Log::error($msg);
                
                abort(503);
            }
            else
            {
                if($target === 'customrole')
                {
                    $roleData = [];
                    if(strtoupper($action) === 'EDIT')
                    {
                        $id = $request->route('userId');
                        if($permission->target == session('user_type') && session('user_id') !== $id)
                        {
                            $msg = 'ACCESS DENIED. User cannot edit other users of the same type.';

                            Session::flash('503_msg', $msg);
                            Log::error($msg);

                            abort(503);
                        }

                        $userData = CustomUser::retrieveData($id);
                        $roleData = UserRoles::getRoleByName($userData->user_type);   
                    }
                    else
                    {
                        $id = $request->route('roleId');
                        $roleData = UserRoles::getRole($id);
                    }

                    if(EMedUtil::isInvalid($roleData))
                    {
                        $msg = 'SYSTEM PROBLEM. User is linked to a custom [User/Role]Id=' . $id . ' that do not exist in the system.';

                        Session::flash('503_msg', $msg);
                        Log::error($msg);

                        abort(503);
                    }
                }
                else
                {

                    if(strtoupper($action) === 'EDIT')
                    {
                        $routeParams = $request->route()->parameters();
                        $idRouteParam = array_values($routeParams)[0];

                        if(session('user_type') === strtoupper($permission->target) && session('user_id') != $idRouteParam)
                        {
                            $msg = 'ACCESS DENIED. User cannot edit other users of the same type.';

                            Session::flash('503_msg', $msg);
                            Log::error($msg);

                            abort(503);
                        }
                    }
                        
                }

                return $next($request);
            }
        }
    }
}
