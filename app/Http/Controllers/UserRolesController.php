<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permissions;
use App\UserRoles;
use Log;

class UserRolesController extends Controller
{
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
                'name'          => 'required',
                'namedisplay'   => 'required',
                'description'   => 'required',
                'permissions'     => 'required'
            ], [
                'name.required'         => 'Please enter user role name.',
                'namedisplay.required'  => 'Please enter user role display name.',
                'description.required'  => 'Please enter user role description.',
                'permissions.required'    => 'Please select at least one permission.'
           ]);

        $input = $request->all();
        Log::info($input);
        UserRoles::saveUserRoles($input);

        return redirect('userroles');
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
        $roleData = UserRoles::getRole($id);
        $allPermissions = Permissions::retrieveAll();

        return view('userroles.edit', [
            'roleData'          => $roleData,
            'permissions'       => $allPermissions
        ]);
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

        return redirect('userroles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserRoles::destroy($id);
        return redirect()->back();
    }
}
