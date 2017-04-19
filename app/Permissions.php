<?php

namespace App;

use DB, Log;

class Permissions
{
    public static function retrieveRolePermissions()
    {
        return DB::table('permissions')
               ->whereRaw(DB::raw('(permissions.id IN (SELECT permission_id FROM permission_role WHERE role_id = ' . session('user_type_id') . '))'))
               ->get();
    }

    public static function hasDeleteUserPermission($id)
    {
        $user_type = DB::table('users')->select('user_type')->where('id', $id)->first()->user_type;
        $data = DB::table('permissions')
                ->whereRaw(DB::raw("((SELECT id FROM permissions WHERE name = 'DELETE_" . strtoupper($user_type) . "' ) IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"))
                ->first();

        return is_null($data) ? $user_type : '';
    }   

    public static function hasUrlPermission($url)
    {
        $data = DB::table('permissions')
                ->whereRaw(DB::raw("((SELECT id FROM permissions WHERE route = '" . strtolower($url) . "' ) IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"))
                ->first();

        return $data;                
    }

    public static function hasAddUserPermission()
    {
        $data = DB::table('permissions')
                ->whereRaw(DB::raw("( permissions.name LIKE 'ADD_USER_%' AND permissions.id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"))
                ->first();

        return $data;
    } 
}
