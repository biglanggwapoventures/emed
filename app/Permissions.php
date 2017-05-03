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
        return DB::table('permission_role')
               ->where('role_id', is_null($roleId) ? session('user_type_id') : $roleId)
               ->where('permission_id', $id)->first();
    }

    public static function hasDeleteUserPermission($id)
    {
        $user_type = DB::table('users')->select('user_type')->where('id', $id)->first()->user_type;
        $data = DB::table('permissions')
                ->whereRaw(DB::raw("((SELECT id FROM permissions WHERE name IN ('DELETE_" . strtoupper($user_type) . "', 'DELETE_CUSTOM_USER_" . strtoupper($user_type) . "') ) IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"))
                ->first();

        return is_null($data) ? $user_type : '';
    }   

    public static function retrieveByURL($url)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("url = '" . $url . "' AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->first();
    }

    public static function retrieveByTargetAndURL($target, $url)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("target = '" . $target . "' AND url = '" . $url . "' AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->first();
    }

    public static function retrieveByRoute($route)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("route = '" . $route . "' AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->first();
    }

    public static function retriveByTargetAndAction($target, $action)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("target = '" . $target . "' AND action = '" . $action . "' AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->first();
    }

    public static function getBasicActionsOfTarget($target)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("target = '" . $target . "' AND action IN ('ADD', 'EDIT', 'DELETE') AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->get();
    }

    public static function getListOfTarget($target)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("target = '" . $target . "' AND action = 'LIST' AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->first();
    }

    public static function getListAndActionsOfTarget($target)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("target = '" . $target . "' AND action IN ('LIST', 'ADD', 'EDIT', 'DELETE') AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->get();
    }

    public static function getAllListAndActions()
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("action IN ('LIST', 'ADD', 'EDIT', 'DELETE') AND id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->get();
    }

    public static function hasPermission($id)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("id = (SELECT permission_id FROM permission_role WHERE permission_id = " . $id . " AND role_id = " . session('user_type_id') . ")"))
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

    public static function hasAddCustomUserPermission()
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("( permissions.name LIKE 'ADD_CUSTOM_USER_%' AND permissions.id IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . "))"))
                ->first();
    }

    public static function getAddCustomUserPermission()
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("permissions.name LIKE 'ADD_CUSTOM_USER_%'"))
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

    public static function getLastPermissionId()
    {
        return DB::table('permissions')
               ->select('id')
               ->orderBy('id', 'DESC')
               ->first()->id;
    }

    public static function deletePermissions($roleId)
    {
        DB::table('permission_role')
            ->where('role_id', $roleId)
            ->delete();
    }

    public static function assignToRole($permissionId, $roleId)
    {
        DB::table('permission_role')
            ->insert(['permission_id' => $permissionId, 'role_id' => $roleId]);
    }

    public static function hasPermissionByName($name)
    {
        return  DB::table('permissions')
                ->whereRaw(DB::raw("(SELECT id FROM permissions WHERE name = '" . $name . "') IN (SELECT permission_id FROM permission_role WHERE role_id = " . session('user_type_id') . ")"))
                ->first();  
    }



    public static function getByRoute()
    {
        
    }
}
