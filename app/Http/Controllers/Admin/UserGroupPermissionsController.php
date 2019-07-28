<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Permissions;
use App\Traits\Logging;
use App\UserGroup;
use App\RolePermission;
use App\RolePermissions;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserGroupPermissionsController extends Controller
{
    use Logging;
    public function listPermissions()
    {
        $permissions = RolePermission::with('rolePermissions')->get();
        return view('admin.Permissions', ['permissions' => $permissions]);
    }

    /**
     * Add an existing permission to a group
     */
    public function assignPermission(Request $request, UserGroup $id)
    {
        /** Needs updating with correct references */
        if(RolePermissions::create([
            'groupID' => $id->id,
            'permissionID' => $request->group
        ])){
            $this->createLog("Assigned permission {$request->group} to group {$id->name}.");
            return redirect()->back()->with('success', 'The permission was associated with the group successfully.')->send();
        }

        $this->createLog("Failed to assign permission {$request->group} to group {$id->name}.");

        return redirect()->back()->withErrors('The permission could not be associated with the group.')->send();
    }

    /**
     * Remove a permission from a group
     *
     * @param Request $request
     * @param UserGroup $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function unassignPermission(Request $request, UserGroup $id)
    {
        //setup some logic to confirm what your doing
        $d = RolePermissions::where('groupID', $id->id)->where('permissionID', $request->permissionID)->delete();
        if($d){
            $this->createLog("Unassigned permission {$request->permissionID} from group {$id->name}.");

            return redirect()->to(Route('admin.usergroups.edit', ['id' => $id->id]))->with('success', 'Successfully removed permission from group.')->send();
        }
        $this->createLog("Failed to Unassign permission {$request->permissionID} from group {$id->name}.");
        return redirect()->to(Route('admin.usergroups.edit', ['id' => $id->id]))->withErrors('There was a problem removing the permission from the group.');
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
            RolePermission::create([
                'name' => $request->name
            ]);
            $this->createLog("Created new permission {$request->name}.");
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
    public function updatePermission(Request $request, RolePermission $id)
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
        $this->createLog("Updated permission {$id->name}.");
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
    public function removePermission(Request $request, RolePermission $id)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.permissions.list'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        try{
            $id->delete();

            $this->createLog('Removed permission from the database.');

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