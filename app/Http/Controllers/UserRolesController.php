<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permissions;
use App\UserRoles;
use Log, Session;

use PermissionHelper;

class UserRolesController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'requirechangepass', 'permissions']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRoles = UserRoles::getUserRoles();
        $allRolesPermissions = Permissions::getPermissionsList();
        return view('userroles.list', ["roles" => $allRoles, "all_permissions" => $allRolesPermissions]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allPermissions = Permissions::retrieveAll();
        return view('userroles.user-roles', ["permissions" => $allPermissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'name'          => 'required|unique:roles',
                'namedisplay'   => 'required',
                'description'   => 'required',
                'permissions'     => 'required'
            ], [
                'name.required'         => 'Please enter user role name.',
                 'name.unique'         => 'Role already apc_exists(keys)',
                'namedisplay.required'  => 'Please enter user role display name.',
                'description.required'  => 'Please enter user role description.',
                'permissions.required'    => 'Please select at least one permission.'
           ]);

        $input = $request->all();
        // Log::info($input);
        UserRoles::saveUserRoles($input);

        return redirect('userroles')
            ->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'New Role added Successfully!'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id <= 6)
        {
            $msg = 'ACCESS DENIED. You cannot edit pre-existing roles.';

            Session::flash('503_msg', $msg);
            Log::error($msg);

            abort(503);
        }
        else
        {
            $roleData = UserRoles::getRole($id);
            $allPermissions = Permissions::retrieveAll();

            return view('userroles.edit', [
                'roleData'          => $roleData,
                'permissions'       => $allPermissions
            ]);
        }

            
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['permissions' => 'required'], ['permissions.required' => 'Please select at least one permission. The current setup will be retained.']);

        $permissionsList = $request->all()['permissions'];

        Permissions::deletePermissions($id);
        foreach ($permissionsList as $permission) 
        {
            Permissions::assignToRole($permission, $id);
        }

        // If there edit/delete permissions for a certain target, the list permission
        // of that certain target will be automatically granted
        PermissionHelper::grantListToEditDelete($id);
        // Log::info('id='. $id);
        // $editDeletePermissions = Permissions::getEditDeleteActionsOfRole($id);
        // Log::info('ED Perm: ' . $editDeletePermissions);
        // foreach ($editDeletePermissions as $permission) 
        // {
        //     $target = $permission->target;
        //     $listPermission = Permissions::getListOfTarget($target, $id);
        //     if(count($listPermission) === 0)
        //     {
        //         $oListPermission = Permissions::retriveByTargetAndAction($target, 'LIST');
        //         Log::info('olistper=' . json_encode($oListPermission));
        //         Permissions::assignToRole($oListPermission->id, $id);
        //     }
        // }

        return redirect('userroles')
         ->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'New Role Edited Successfully!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permissions::deletePermissions($id, true);
        UserRoles::destroy($id);
        return redirect()->back();
    }
}

