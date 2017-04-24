<?php

namespace App;

use DB, Log;

class Permissions
{
    public static function retrieveAll()
    {
        return DB::table('permissions')
               ->orderBy('display_name')->get();
    }

    public static function retrieveRolePermissions()
    {
        return DB::table('permissions')
               ->whereRaw(DB::raw('(permissions.id IN (SELECT permission_id FROM permission_role WHERE role_id = ' . session('user_type_id') . '))'))
               ->get();
    }

    public static function retrieveRoleOnPermissionId($id, $roleId = null)
    {
        return DB::table('permission_role')->where('role_id', is_null($roleId) ? session('user_type_id') : $roleId)->where('permission_id', $id)->first();
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
        return  DB::table('permissions')
                ->whereRaw(DB::raw("((SELECT id FROM permissions WHERE route = '" . strtolower($url) . "' ) IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"))
                ->first();            
    }

    public static function hasAddUserPermission()
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("( permissions.name LIKE 'ADD_USER_%' AND permissions.id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"))
                ->first();
    } 

    public static function getAddUserPermission()
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("permissions.name LIKE 'ADD_USER_%'"))
                ->get();
    }

    public static function getPermissionsList($roleId = null)
    {
        if(is_null($roleId))
        {
            $data =  DB::table('permission_role')->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
                    ->select('permission_role.role_id', 'permission_role.permission_id', 'permissions.display_name')
                    ->orderBy('permission_role.role_id')
                    ->orderBy('permissions.display_name')->get();
        }
        else
        {
            $data =  DB::table('permission_role')->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
                    ->select('permission_role.role_id', 'permission_role.permission_id', 'permissions.display_name')
                    ->where('permission_role.role_id', $roleId)
                    ->orderBy('permission_role.role_id')
                    ->orderBy('permissions.display_name')->get();
        }
        
        return $data;
    }
}
