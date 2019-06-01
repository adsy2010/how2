<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Permissions;
use App\UserGroup;
use App\UserGroupPermission;
use App\UserGroupPermissions;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserGroupPermissionsController extends Controller
{

    public function listPermissions()
    {
        $permissions = UserGroupPermission::all();
        return view('admin.Permissions', ['permissions' => $permissions]);
    }

    /**
     * Add an existing permission to a group
     */
    public function addPermissionToGroup(Request $request, UserGroup $id)
    {
        /** Needs updating with correct references */
        UserGroupPermissions::create([
            'groupID' => $id->id,
            'permissionID' => $request->permissionID
        ]);
    }

    /**
     * Remove a permission from a group
     *
     * @param Request $request
     * @param UserGroup $id
     */
    public function removePermissionFromGroup(Request $request, UserGroup $id)
    {
        //setup some logic to confirm what your doing
        $id->whereHas('permissions', function ($query, $request) {
            $query->where('permissionID', $request->permissionID);
        })->delete();
    }


    /**
     * Create a new permission
     */
    public function addPermission(Request $request)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.permissions.list'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        //Check form data and create group
        if($this->validate($request, [
            'name' => 'required|min:3|unique:permission'
        ])) {
            UserGroupPermission::create([
                'name' => $request->name
            ]);
            return redirect()->to(Route('admin.permissions.list'))
                ->with('success', __('admin.success-addedpermission'))
                ->send();
        }

        // Emergency escape method if there have been no returns
        return redirect()->to(Route('admin.permissions.list'))
            ->withInput($request->all())
            ->withErrors(__('admin.error-addedpermission'))
            ->send();
    }

    /**
     * Update a permission
     *
     * WARNING: This may cause instability throughout the application
     */
    public function updatePermission(Request $request, UserGroupPermission $id)
    {
        // TODO: Check requirements then save and return to permissions list
        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.permissions.list'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        if($this->validate($request, [
            'name' => 'required|min:3|unique:permission'
        ]))
        {
            $id->name = $request->name;

            //TODO: Update language references if necessary
            return redirect()->to(Route('admin.permissions.list'))
                ->with('success', __('admin.success-addedpermission'))
                ->send();
        }

        $id->save(); //might as well save it even if there's no changes just in case.

        //TODO: Update language references if necessary
        return redirect()->to(Route('admin.permissions.list'))
            ->withInput($request->all())
            ->withErrors(__('admin.error-addedpermission'))
            ->send();
    }

    /**
     * Remove a permission
     *
     * WARNING: This may cause instability throughout the application
     */
    public function removePermission(Request $request, UserGroupPermission $id)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.permissions.list'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        try{
            $id->delete();

            //TODO: Update language references if necessary
            return redirect()->to(Route('admin.permissions.list'))
                ->with('success', __('admin.success-addedpermission'))
                ->send();

        }
        catch (Exception $exception)
        {

        }

        //fall through redirect as an error

        //TODO: Update language references if necessary
        return redirect()->to(Route('admin.permissions.list'))
            ->withInput($request->all())
            ->withErrors(__('admin.error-addedpermission'))
            ->send();
    }

    /**
     * Page to show linked groups
     *
     * @param Request $request
     */
    public function showPermission(Request $request)
    {
        //TODO: Add later
        return;
    }
}