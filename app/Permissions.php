<?php

namespace App;

use DB, Log;

class Permissions
{
    public static function retrieveRolePermissions($roleId)
    {
        return DB::table('permissions')
               ->whereRaw(DB::raw('(permissions.id IN (SELECT permission_id FROM permission_role WHERE role_id = ' . $roleId . '))'))
               ->get();
    }

    public static function hasDeleteUserPermission($id)
    {
        $user_type = DB::table('users')->select('user_type')->where('id', $id)->first()->user_type;
        $data = DB::table('permissions')
                ->whereRaw(DB::raw("((SELECT id FROM permissions WHERE name = '" . 'DELETE_' . strtoupper($user_type) . "' ) IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"));

        return is_null($data) ? $user_type : '';
    }   
}
