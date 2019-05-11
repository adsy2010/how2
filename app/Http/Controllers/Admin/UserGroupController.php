<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\UserGroup;
use App\UserGroupMember;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{

    public function listGroups()
    {
        return view('admin.UserGroups');
    }

    public function groupInfo()
    {
        return view('admin.UserGroup');
    }

    /**
     * Create a user group
     */
    public function createGroup(Request $request)
    {
        //TODO: Add logic to verify creation

        if(!$request->isMethod('post'))
            return; //TODO: Return fail error message

        UserGroup::create([

        ]);
    }


    /**
     * Delete a user group
     *
     * @param Request $request
     * @param UserGroup $id
     */
    public function deleteGroup(Request $request, UserGroup $id)
    {
        //TODO: Display confirmation, consider consolidating with confirm method
    }

    /**
     * Delete a user group confirmation
     *
     * @param Request $request
     * @param UserGroup $id
     */
    public function deleteGroupConfirm(Request $request, UserGroup $id)
    {

    }


}