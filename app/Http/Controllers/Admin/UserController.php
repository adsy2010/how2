<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use App\UserGroup;
use App\UserGroupMember;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listUsers()
    {
        return view('admin.users', ['users' => User::paginate(15)]);
    }

    public function showUser(Request $request, User $id)
    {
        $groups = UserGroup::whereNotIn('id', $id->usergroups()->pluck('groupID'))->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.user', ['user' => $id, 'groups' => $groups]);
    }

    /**
     * Remove a user from a user group
     */
    public function removeMemberFromGroup(Request $request, User $id)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.users.view', ['id' => $request->id]))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        try{
            UserGroupMember::where('userID', $id->id)->where('groupID', $request->groupID)->delete();

            return redirect()->to(Route('admin.users.view', ['id' => $id->id]))
                ->with('success', __('admin.success-deletedmembergroup'))
                ->send();
        }
        catch (Exception $exception)
        {
            //die($exception->getMessage());
            // Emergency escape method if there have been no returns
            return redirect()->to(Route('admin.users.view', ['id' => $request->id]))
                ->withInput($request->all())
                ->withErrors(__('admin.error-deletedmembergroup'))
                ->send();
        }

    }

    /**
     * Add a member to a user group
     *
     * @param Request $request
     * @param User $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addMemberToGroup(Request $request, User $id)
    {
        //TODO: Add logic to verify addition

        if(!$request->isMethod('post'))
            return redirect()->to(Route('admin.users.view', ['id' => $request->id]))
                ->withErrors(__('admin.error-badmethod'))
                ->send();

        //Check form data and create group
        if($this->validate($request, [
            'group' => 'required'
        ]))
        {

            UserGroupMember::create([
                'groupID' => $request->group,
                'userID' => $id->id
            ]);

            return redirect()->to(Route('admin.users.view', ['id' => $id->id]))
                ->with('success', __('admin.success-addedgroup'))
                ->send();
        }

        // Emergency escape method if there have been no returns
        return redirect()->to(Route('admin.users.view', ['id' => $request->id]))
            ->withInput($request->all())
            ->withErrors(__('admin.error-addedmembergroup'))
            ->send();
    }
}