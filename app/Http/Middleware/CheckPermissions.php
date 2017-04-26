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

            $continue = true;
            $msg = "";
            $roleClause = "";

            if(strpos($currentRoute, 'create') !== false)
            {
                $roleData = UserRoles::getRole($id);

                if(is_null($roleData))
                {
                    $continue = false;
                    $msg = 'ACCESS DENIED. User tries to access data for custom RoleId=' . $id . ' but does not exist in the system.';
                }
                else
                {
                    $roleName = $roleData->name;
                    $roleClause = EMedHelper::getCreatePermissionClauseForRole($roleName);
                }
            }
            elseif(strpos($currentRoute, 'edit') !== false)
            {
                $continue = true;

                if(session('user_type_id') != 1)
                {
                    $user = Auth::user();

                    if($id != $user->id)
                    {
                        $continue = false;
                    }
                }

                if($continue)
                {
                    $userData = CustomUser::retrieveData($id);

                    if(is_null($userData))
                    {
                        $msg = 'ACCESS DENIED. User tries to access data for custom UserId=' . $id . ' but does not exist in the system.';

                        Session::flash('503_msg', $msg);
                        Log::error($msg);

                        abort(503);
                    }
                    else
                    {  
                        if(is_null($userData->user_type_id))
                        {
                            $roleData = UserRoles::getRoleByName($userData->user_type);   
                        }
                        else
                        {
                            $roleData = UserRoles::getRole($userData->user_type_id);  
                        }

                        if(is_null($roleData))
                        {
                            $continue = false;
                            $msg = 'SYSTEM PROBLEM. User is linked to a custom RoleId=' . $id . ' that does not exist in the system.';
                        }
                        else
                        {   
                            $roleName = $roleData->name;
                            $roleClause = EMedHelper::getEditPermissionClauseForRole($roleName);
                        }
                    }
                }
                else
                {
                    $msg = 'ACCESS DENIED. User tries to access data for custom UserId=' . $id . ' but is not included in the current user\'s list of permissions.';

                    Session::flash('503_msg', $msg);
                    Log::error($msg);

                    abort(503);
                }
                    
            }
            else
            {
                $msg = 'SYSTEM PROBLEM. This should not happen. Check route and confirm as to why this occurred.';

                Session::flash('503_msg', $msg);
                Log::error($msg);

                abort(503);
            }


            if($continue)
            {
                $roleDispName = $roleData->display_name;

                $data = Permissions::hasPermissionByName($roleClause);
                Session::put('custom_role', $roleDispName);
            }
            else
            {
                Session::flash('503_msg', $msg);
                Log::error($msg);
                abort(503);
            }
        }
        else
        {
            $data = Permissions::hasUrlPermission($currentRoute);
        }
        
        Log::info(session('custom_role'));

        Log::info('Route accessed: ' . $currentRoute);

        $continue = !is_null($data);

        if($continue)
        {
            Log::info('ACCESS GRANTED for Route=' . $currentRoute);
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
