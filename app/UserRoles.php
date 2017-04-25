<?php

namespace App;

use App\Permissions;

use DB;

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

        DB::table('roles')->insert($roleData);

        $permissions = $data['permissions'];
        $newRoleId = self::getLastUserRoleId();

        foreach($permissions as $permission)
        {
            Permissions::assignToRole($permission, $newRoleId);
        }

        $newPermission = 
        [
            "name"          => "CUSTOM_" . strtoupper($data['name']) . "_LIST",
            "display_name"  => "List of " . $data['namedisplay'],
            "description"   => "List of " . $data['namedisplay'],
            "is_view"       => 1,
            "is_modal"      => 0,
            "route"         => "SELECT id FROM permissions WHERE route", //this should be generic, something like role.index or something
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);

        $newPermission = 
        [
            "name"          => "ADD_CUSTOM_USER_" . strtoupper($data['name']),
            "display_name"  => "Add " . $data['namedisplay'],
            "description"   => "Add " . $data['namedisplay'],
            "is_view"       => 1,
            "is_modal"      => 0,
            "route"         => "role.create", //this should be generic, something like role.create or something
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);

        $newPermission = 
        [
            "name"          => "EDIT_CUSTOM_USER_" . strtoupper($data['name']),
            "display_name"  => "Edit " . $data['namedisplay'],
            "description"   => "Edit " . $data['namedisplay'],
            "is_view"       => 1,
            "is_modal"      => 0,
            "route"         => "role.edit", //this should be generic, something like role.edit or something
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);

        $newPermission = 
        [
            "name"          => "VIEW_CUSTOM_USER_" . strtoupper($data['name']),
            "display_name"  => "View " . $data['namedisplay'],
            "description"   => "View " . $data['namedisplay'],
            "is_view"       => 0,
            "is_modal"      => 1,
            "route"         => "modal", //this should be generic, something like role.show or something
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);

        $newPermission = 
        [
            "name"          => "DELETE_CUSTOM_USER_" . strtoupper($data['name']),
            "display_name"  => "Delete " . $data['namedisplay'],
            "description"   => "Delete " . $data['namedisplay'],
            "is_view"       => 1,
            "is_modal"      => 0,
            "route"         => "role.destroy", //this should be generic, something like role.destroy or something
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date("Y-m-d H:i:s")
        ];

        DB::table('permissions')->insert($newPermission);

        $newPermissionId = Permissions::getLastPermissionId();
        Permissions::assignToRole($newPermissionId, 1);
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
