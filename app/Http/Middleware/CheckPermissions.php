<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Session;
use Route, Request, EMedHelper, Auth;

use App\Permissions;
use App\UserRoles;
use App\CustomUser;

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
            $lastDelimeterPos = strrpos($requestPath, '/');

            $currentRoute = substr($requestPath, 0, $lastDelimeterPos);

            $id = substr($requestPath, $lastDelimeterPos+1, strlen($requestPath) - 1);

            if(strpos($currentRoute, 'edit') !== false)
            {
                $userId = $id;
                $userData = CustomUser::retrieveData($userId);

                if(is_null($userData->user_type_id))
                {
                    $roleData = UserRoles::getRoleByName($userData->user_type);   
                }
                else
                {
                    $roleData = UserRoles::getRole($userData->user_type_id);  
                }

                if(session('user_type') === $roleData->name && $userId !== session('user_id'))
                {
                    $msg = 'ACCESS DENIED. User cannot edit other users of the same type.';

                    Session::flash('503_msg', $msg);
                    Log::error($msg);

                    abort(503);
                }
                else
                {
                    if(is_null($roleData))
                    {
                        $msg = 'SYSTEM PROBLEM. User is linked to a custom RoleId=' . $id . ' that does not exist in the system.';

                        Session::flash('503_msg', $msg);
                        Log::error($msg);

                        abort(503);
                    }
                }
            }
            else
            {
                $roleData = UserRoles::getRole($id);
            }

            
            if(is_null($roleData) || empty($roleData) || count($roleData) <= 0)
            {
                $msg = 'ACCESS DENIED. System cannot identify current access route of role. Route=' . $currentRoute . '; RoleId=' . $id;

                Session::flash('503_msg', $msg);
                Log::error($msg);

                abort(503);
            }
            else
            {
                Session::put('custom_role', $roleData->display_name);
                Session::put('custom_role_type', $roleData->name);
                Session::put('custom_role_id', $roleData->id);
                $data = Permissions::retrieveByTargetAndURL($roleData->name, $currentRoute);
            }
        }
        else
        {
            $data = Permissions::retrieveByRoute($currentRoute);
            if(is_null($data))
            {
                $permission = Permissions::retrieveDataByRouteOnly($currentRoute);
                if(is_null($permission))
                {
                    $msg = 'ACCESS DENIED. User tries to access Route=' . $currentRoute . ' that does not exist .';

                    Session::flash('503_msg', $msg);
                    Log::error($msg);
                    
                    abort(503);
                }
                if($permission->action === 'LIST')
                {
                    $data = EMedHelper::showListOfTarget($permission->target);
                }
            }
        }
        
        // Log::info('Route accessed: ' . $currentRoute);

        $continue = !is_null($data);

        if($continue)
        {
            // Log::info('ACCESS GRANTED for Route=' . $currentRoute);
            return $next($request);
        }
        else
        {
            $msg = 'ACCESS DENIED. User tries to access Route=' . $currentRoute . ' but is not included in the current user\'s list of permissions.';

            Session::flash('503_msg', $msg);
            Log::error($msg);
            
            abort(503);
        }
    }
}
