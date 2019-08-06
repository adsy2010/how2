<?php

use App\RolePermission;
use App\RolePermissions;
use App\UserGroup;
use App\UserGroupMember;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RolePermission::create(['name' => 'Administrator']);
        RolePermission::create(['name' => 'Create Submission']);
        RolePermission::create(['name' => 'Feedback']);
        UserGroup::create(['name' => 'Administrators']);
        UserGroupMember::create(['userID' => 1, 'groupID' =>1]);
        RolePermissions::create(['groupID' => 1, 'permissionID'=> 1]);
    }
}
