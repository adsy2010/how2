<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 14/07/2019
 * Time: 15:51
 */

namespace App\Traits;

use App\RolePermission;
use App\User;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

/**
 * This is designed to check a users groups permissions
 *
 * Trait Role
 * @package App\Traits
 */
trait Role
{
    /** check membership */
    protected function check($membership)
    {
        //return (Auth::user()->usergroups->pluck('groupInfo')->pluck('name');
        return (Auth::user()->hasRole($membership));
    }

    /** Check membership roles */
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

        /*
        $collection = array();
        foreach ($permissions->usergroups as $a)
        {
            foreach ($a->groupInfo->permissions as $b)
            {
                $collection[] = $b['permissions'][0];
            }
        }
        echo json_encode($collection, JSON_PRETTY_PRINT);
        echo $collection[1]['name'];
        return (in_array('Administrator', $collection))? 'true': 'false';
//        return (in_array('Administrator', $collection))? 'true': 'false';
        return;// implode('<br>',$collection);

        return $permissions;
        */
    }
}