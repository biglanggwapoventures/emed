<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Session;
use Route, Request, Auth;

use App\Permissions;
use App\UserRoles;
use App\CustomUser;
use App\Common;

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
            
            $actions = EMedUtil::recreateRouteAction($routeData->action);

            $action = $actions->new;
            $oldAction = $actions->old;

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
                            Log::info('userid from checker = ' . $id);
                            Log::info('current userid = ' . session('user_id'));
                        if($permission->target == session('user_type') && session('user_id') != $id)
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
                    $routeParams = $request->route()->parameters();
                    if(strtoupper($action) === 'EDIT')
                    {
                        if(session('user_type') == strtoupper($permission->target))
                        {
                            $routeParams = $request->route()->parameters();

                            $routeParamValues = array_values($routeParams);
                            $routeParamKeys = array_keys($routeParams);

                            $idRouteParam = $routeParamValues[0];
                            $idRouteKey = $routeParamKeys[0];

                            
                            Log::info('trace:'.$idRouteKey);
                            Log::info('trace:'.$idRouteParam);
                            switch (strtoupper($idRouteKey)) 
                            {
                                case 'PATIENT':
                                    $userId = Common::getPatientUserId($idRouteParam);
                                    break;
                                case 'SECRETARY':
                                    $userId = Common::getSecretaryUserId($idRouteParam);
                                    break;
                                default:
                                    $userId = $idRouteParam;

                            }

                            // This is where we check if the UPDATE has been changed to EDIT by
                            // the system for conformity purposes
                            if($action !== $oldAction)
                            {
                                switch (strtoupper($idRouteKey)) 
                                {
                                    case 'PATIENT':
                                        $userId = Common::getPatientUserId($idRouteParam);
                                        break;
                                    case 'SECRETARY':
                                        $userId = Common::getSecretaryUserId($idRouteParam);
                                        break;
                                    case 'PHARMACIST':
                                        $userId = Common::getPharmaUserId($idRouteParam);
                                        break;
                                    case 'MANAGER':
                                        $userId = Common::getManagerUserId($idRouteParam);
                                        break;
                                    case 'DOCTOR':
                                        $userId = Common::getDoctorUserId($idRouteParam);
                                        break;
                                }
                            }

                            Log::info('userid from checker = ' . $userId);
                            Log::info('current userid = ' . session('user_id'));

                            if(session('user_id') != $userId)
                            {
                                $msg = 'ACCESS DENIED. User cannot edit other users of the same type.';

                                Session::flash('503_msg', $msg);
                                Log::error($msg);

                                abort(503);
                            }
                        }
                            
                    }
                        
                }

                return $next($request);
            }
        }
    }
}

