<?php
    namespace App\Helpers;

    use App\Permissions;
    use App\UserRoles;

    use Log;

    class EMedHelper
    {
        public static function hasRoutePermission($route)
        {
            $data = Permissions::retrieveByRoute($route);
            return count($data) > 0;
        }

        public static function showListOfTarget($target)
        {
            Log::info('Checking if user has permissions to any action that gives the list of ' . $target);

            $data = Permissions::getListAndActionsOfTarget($target);
            $permissionCount = count($data); 
            $flag = $permissionCount > 0;

            if($permissionCount === 1)
            {
                Log::info('Permission count is only 1. Verifying if it\'s an edit permission of it\'s own user type');
                $permission = $data{0};

                if(strtoupper(session('user_type_name')) === strtoupper($permission->target))
                {
                    Log::info('Verified - It\'s a self-user type edit permission. This permission is for user profile update only. Updating flag to FALSE.');
                    $flag = false;
                }
                else
                {
                    Log::info('Verified - It\'s not a self-user type edit permission. ');
                }
            }

            Log::info(($flag ? 'GRANTED' : 'DENIED') . '. Permission count = ' . $permissionCount);

            return $flag;
        }

        public static function hasTargetActionPermission($target, $action)
        {
            $data = Permissions::retriveByTargetAndAction($target, $action);
            return count($data) > 0;
        }

        public static function getCustomRoles()
        {
            $data = UserRoles::getCustomRoles();
            return $data;
        }        

        // public static function hasAddUserPermission()
        // {
        //     $data = Permissions::hasAddUserPermission();
        //     return is_null($data) ? false : true;
        // }

        // public static function getAddUserPermissions()
        // {
        //     $data = Permissions::getAddUserPermission();
        //     return $data;
        // }

        // public static function hasAddCustomUserPermission()
        // {
        //     $data = Permissions::hasAddCustomUserPermission();
        //     return is_null($data) ? false : true;
        // }

        // public static function getAddCustomUserPermissions()
        // {
        //     $data = Permissions::getAddCustomUserPermission();
        //     return $data;
        // }

        public static function hasPermissionId($id, $roleId = null)
        {
            $data = Permissions::retrieveRoleOnPermissionId($id, $roleId);
            return is_null($data) ? false : true;
        }

        public static function retrieveRoleIdByName($rawAddName)
        {
            $name = substr($rawAddName, 16, (strlen($rawAddName) - 16));
            return UserRoles::getRoleByName($name)->id;
        }

        public static function getCreatePermissionClauseForRole($roleName)
        {
            return "ADD_CUSTOM_USER_" . strtoupper($roleName);
        }

        public static function getEditPermissionClauseForRole($roleName)
        {
            return "EDIT_CUSTOM_USER_" . strtoupper($roleName);
        }

        public static function getDeletePermissionClauseForRole($roleName)
        {
            return "DELETE_CUSTOM_USER_" . strtoupper($roleName);
        }
    }
?>