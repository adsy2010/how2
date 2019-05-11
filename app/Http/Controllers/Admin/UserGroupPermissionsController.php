<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Permissions;
use App\UserGroup;
use Illuminate\Http\Request;

class UserGroupPermissionsController extends Controller
{

    public function listPermissions()
    {
        return view('admin.Permissions');
    }

    /**
     * Add an existing permission to a group
     */
    public function addPermissionToGroup()
    {
        Permissions::create([

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

    }


    /**
     * Create a new permission
     */
    public function addPermission()
    {

    }

    /**
     * Update a permission
     *
     * WARNING: This may cause instability throughout the application
     */
    public function updatePermission()
    {

    }

    /**
     * Remove a permission
     *
     * WARNING: This may cause instability throughout the application
     */
    public function removePermission()
    {

    }
}