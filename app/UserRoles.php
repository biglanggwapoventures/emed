<?php

namespace App;

use App\Permissions;

use DB;
use Log;

class UserRoles
{
    public static function saveUserRoles($data)
    {
        $roleData = 
        [
            "name"          => strtoupper($data['name']), 
            "display_name"  => $data['namedisplay'],
            "description"   => $data['description'],
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date("Y-m-d H:i:s")
        ];

        Log::info('Attempting to add new role data: ' . json_encode($roleData));
        DB::table('roles')->insert($roleData);
        Log::info('Successfully added new role data.');

        $permissions = $data['permissions'];
        $newRoleId = self::getLastUserRoleId();

        foreach($permissions as $permission)
        {
            Permissions::assignToRole($permission, $newRoleId);
        }

        // If there edit/delete permissions for a certain target, the list permission
        // of that certain target will be automatically granted
        $editDeletePermissions = Permissions::getEditDeleteActionsOfRole($newRoleId);
        foreach ($editDeletePermissions as $permission) 
        {
            $target = $permission->target;
            $listPermission = Permissions::getListOfTarget($target, $newRoleId);
            if(count($listPermission) === 0)
            {
                $oListPermission = Permission::retriveByTargetAndAction($target, 'LIST');
                Permissions::assignToRole($oListPermission->id, $newRoleId);
            }
        }

        Log::info('Selected roles have now been mapped to new user role' . json_encode($permissions));

        $newPermission = [
            "name"              => "CUSTOM_" . strtoupper($data['name']) . "_LIST",
            "display_name"      => "List of All " . $data['namedisplay'],
            "description"       => "List of All " . $data['namedisplay'],
            "type"              => "page",
            "target"            => strtoupper($data['name']),
            "action"            => "LIST",
            "route"             => "",
            "url"               => "custom-role",
            "allow_in_custom"   => 1,
            "created_at"        => date("Y-m-d H:i:s"),
            "updated_at"        => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);
        Log::info('Custom user role list for ' . $data['namedisplay'] . ' permission has now been created and assigned to admin user.');

        $newPermission = [
            "name"              => "ADD_USER_CUSTOM_" . strtoupper($data['name']),
            "display_name"      => "Add User " . $data['namedisplay'],
            "description"       => "Add User " . $data['namedisplay'],
            "type"              => "page",
            "target"            => strtoupper($data['name']),
            "action"            => "ADD",
            "route"             => "",
            "url"               => "custom-role/create",
            "allow_in_custom"   => 1,
            "created_at"        => date("Y-m-d H:i:s"),
            "updated_at"        => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);
        Log::info('Custom add user role for ' . $data['namedisplay'] . ' permission has now been created and assigned to admin user.');

        $newPermission = [
            "name"              => "EDIT_USER_CUSTOM_" . strtoupper($data['name']),
            "display_name"      => "Edit User " . $data['namedisplay'],
            "description"       => "Edit User " . $data['namedisplay'],
            "type"              => "page",
            "target"            => strtoupper($data['name']),
            "action"            => "EDIT",
            "route"             => "",
            "url"               => "custom-role/edit",
            "allow_in_custom"   => 1,
            "created_at"        => date("Y-m-d H:i:s"),
            "updated_at"        => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);
        Permissions::assignToRole($newPermissionId, $newRoleId);
        Log::info('Custom edit user role for ' . $data['namedisplay'] . ' permission has now been created and assigned to new user role and admin user.');

        $newPermission = [
            "name"              => "DELETE_USER_CUSTOM_" . strtoupper($data['name']),
            "display_name"      => "Delete User " . $data['namedisplay'],
            "description"       => "Delete User " . $data['namedisplay'],
            "type"              => "modal",
            "target"            => strtoupper($data['name']),
            "action"            => "DELETE",
            "route"             => "users.destroy",
            "url"               => "",
            "allow_in_custom"   => 1,
            "created_at"        => date("Y-m-d H:i:s"),
            "updated_at"        => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);
        Log::info('Custom delete user role for ' . $data['namedisplay'] . ' permission has now been created and assigned to admin user.');
    }

    public static function getLastUserRoleId()
    {
        return DB::table('roles')->select('id')->orderBy('id', 'DESC')->first()->id;
    }

    public static function getUserRoles()
    {
        return DB::table('roles')->orderBy('id')->get();
    }

    public static function getRole($id)
    {
        return DB::table('roles')->where('id', $id)->first();
    }

    public static function getRoleByName($name)
    {
        return DB::table('roles')->where('name', $name)->first();
    }

    public static function getCustomRoles()
    {
        return DB::table('roles')->where('id', '>', 6)->get();
    }

    public static function destroy($id)
    {
        $roleData = self::getRole($id);
        DB::table('roles')->where('id', $id)->delete();

        $listPermission = "CUSTOM_" . strtoupper($roleData->name) . "_LIST";
        $addPermission = "ADD_CUSTOM_USER_" . strtoupper($roleData->name);
        $editPermission = "EDIT_CUSTOM_USER_" . strtoupper($roleData->name);
        $viewPermission = "VIEW_CUSTOM_USER_" . strtoupper($roleData->name);
        $deletePermission = "DELETE_CUSTOM_USER_" . strtoupper($roleData->name);

        DB::table('permissions')
        ->whereIn('name', [$listPermission, $addPermission, $editPermission, $viewPermission, $deletePermission])
        ->delete();
    }
}
