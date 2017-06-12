<?php
    namespace App\Helpers;

    use App\Permissions;

    use Log;

    class PermissionHelper
    {
        public static function grantListToEditDelete($roleId)
        {
            $editDeletePermissions = Permissions::getEditDeleteActionsOfRole($roleId);
            foreach ($editDeletePermissions as $permission) 
            {
                $target = $permission->target;
                $listPermission = Permissions::getListOfTarget($target, $roleId);
                if(count($listPermission) === 0)
                {
                    $oListPermission = Permissions::retriveByTargetAndAction($target, 'LIST');
                    Permissions::assignToRole($oListPermission->id, $roleId);
                }
            }
        }
    }
?>
<!-- hello -->