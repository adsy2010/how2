<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 14/07/2019
 * Time: 15:51
 */

namespace App\Traits;

use App\RolePermission;
use Illuminate\Support\Facades\Auth;

/**
 * This is designed to check the current users groups and their permissions
 *
 * Trait Role
 * @package App\Traits
 */
trait Role
{
    /**
     * Check current user's group memberships
     *
     * @param string The group to check for membership of
     * @return bool True if a role membership is found, false otherwise
     */
    protected function check($membership)
    {
        return (Auth::user()->hasRole($membership));
    }

    /**
     * Checks for membership role permissions for the current user
     *
     * @param string The permission to check for
     * @return bool true if a permission is found, false otherwise
     */
    protected function permissions($permission)
    {
        $permissions = RolePermission::distinct()
            ->select('permission.name')
            ->join('permissions','permission.id', '=','permissions.permissionID')
            ->join('usergroups','permissions.groupID', '=','usergroups.id')
            ->join('usergroupmembers','usergroups.id', '=','usergroupmembers.groupID')
            ->where('usergroupmembers.userID', Auth::id())
            ->where('permission.name', $permission)
            ->get();
        /*
         * SELECT DISTINCT permission.name FROM permission
              INNER JOIN permissions ON permission.id = permissions.permissionID
              INNER JOIN usergroups ON permissions.groupID = usergroups.id
              INNER JOIN  usergroupmembers ON usergroups.id = usergroupmembers.groupID
            WHERE usergroupmembers.userID = 2
         * */


        return (count($permissions) > 0) ? true : false;
    }
}