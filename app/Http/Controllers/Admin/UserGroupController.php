<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Traits\Logging;
use App\UserGroup;
use App\UserGroupMember;
use App\RolePermission;
use Illuminate\Http\Request;
use Exception;

class UserGroupController extends Controller
{
    use Logging;
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listGroups()
    {
        return view('admin.UserGroups', ['groups' => UserGroup::paginate(15)]);
    }

    /**
     * @param Request $request
     * @param UserGroup $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showGroup(Request $request, UserGroup $id)
    {
        $permissions = RolePermission::whereNotIn('id', $id->permissions->pluck('permissionID'))->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.UserGroup', ['group' => $id, 'permissions' => $permissions]);
    }

    /**
     * @param Request $request
     * @param UserGroup $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateGroup(Request $request, UserGroup $id)
    {
        /** TODO: Check language definitions are correct and update as required */
        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.usergroups.list'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        //Check form data and create group
        if($this->validate($request, [
            'name' => 'required|min:3|unique:usergroups'
        ]))
        {
            $id->name = $request->name;
            $id->save();

            return redirect()->to(Route('admin.usergroups.list'))
                ->with('success', __('admin.success-addedgroup'))
                ->send();
        }

        return redirect()->to(Route('admin.usergroups.list'))
            ->withInput($request->all())
            ->withErrors(__('admin.error-addedgroup'))
            ->send();
    }

    /**
     * Create a user group
     */
    public function createGroup(Request $request)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.usergroups.list'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        //Check form data and create group
        if($this->validate($request, [
            'name' => 'required|min:3|unique:usergroups'
        ]))
        {
            UserGroup::create([
                'name' => $request->name
            ]);
            return redirect()->to(Route('admin.usergroups.list'))
                ->with('success', __('admin.success-addedgroup'))
                ->send();
        }

        // Emergency escape method if there have been no returns
        return redirect()->to(Route('admin.usergroups.list'))
            ->withInput($request->all())
            ->withErrors(__('admin.error-addedgroup'))
            ->send();

    }

    /**
     * Delete a user group
     *
     * @param Request $request
     * @param UserGroup $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteGroup(Request $request, UserGroup $id)
    {
        //TODO: Display confirmation, consider consolidating with confirm method
        return view('admin.UserGroupDeleteConfirm', ['group' => $id]);
    }

    /**
     * Delete a user group confirmation
     *
     * @param Request $request
     * @param UserGroup $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGroupConfirm(Request $request, UserGroup $id)
    {
        try{
            $cleargroup = $id->id;
            $id->delete();
            UserGroupMember::where('groupID', $cleargroup)->delete();
            return redirect()->to(Route('admin.usergroups.list'))->with('success', 'Successfully removed group from the database');
        }
        catch (Exception $exception)
        {
            return redirect()->to(Route('admin.usergroups.list'))->withErrors($exception->getMessage());
        }

    }


}
