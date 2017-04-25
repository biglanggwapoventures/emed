<?php
    namespace App\Helpers;

    use App\Permissions;
    use App\UserRoles;

    use Log;

    class EMedHelper
    {
        public static function hasUrlPermission($url)
        {
            $data = Permissions::hasUrlPermission($url);
            return is_null($data) ? false : true;
        }

        public static function hasAddUserPermission()
        {
            $data = Permissions::hasAddUserPermission();
            return is_null($data) ? false : true;
        }

        public static function getAddUserPermissions()
        {
            $data = Permissions::getAddUserPermission();
            return $data;
        }

        public static function hasAddCustomUserPermission()
        {
            $data = Permissions::hasAddCustomUserPermission();
            return is_null($data) ? false : true;
        }

        public static function getAddCustomUserPermissions()
        {
            $data = Permissions::getAddCustomUserPermission();
            return $data;
        }

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