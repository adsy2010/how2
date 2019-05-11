<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\UserGroup;
use App\UserGroupMember;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Remove a user from a user group
     */
    public function removeMemberFromGroup(Request $request, UserGroup $id)
    {

    }

    /**
     * Add a member to a user group
     */
    public function addMemberToGroup()
    {
        //TODO: Add logic to verify addition
        UserGroupMember::create([

        ]);
    }
}