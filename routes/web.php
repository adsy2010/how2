<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@welcome')->name('root');

Auth::routes();

Route::prefix('home')->group(function(){
    Route::get('/', 'HomeController@dashboard')->name('home');
    Route::get('feedback', 'HomeController@feedback')->name('user.feedback');
    Route::get('submissions', 'HomeController@submissions')->name('user.submissions');
});
Route::prefix('admin')->group(function (){
    Route::get('/', 'Admin\AdminController@dashboard')->name('admin.dashboard');
    Route::get('logs', 'Admin\AdminController@logs')->name('admin.logs');
    Route::prefix('users')->group(function (){
        Route::get('/', 'Admin\UserController@listUsers')->name('admin.users.list');
        Route::get('{id}', 'Admin\UserController@showuser')->name('admin.users.view');
        //Route::get('{id}/usergroups', function (){ return; })->name('admin.usersgroups.list');
        Route::post('{id}/assigngroup', 'Admin\UserController@addMemberToGroup')->name('admin.usersgroups.assign');
        Route::post('{id}/unassigngroup', 'Admin\UserController@removeMemberFromGroup')->name('admin.usersgroups.unassign');
    });
    Route::prefix('search')->group(function() {
        Route::get('/', 'SearchController@dashboard')->name('admin.search.dashboard');
        Route::get('clear/cache', 'SearchController@clearCache')->name('admin.search.clear.cache');
        Route::get('clear/terms', 'SearchController@clearSearch')->name('admin.search.clear.terms');
        Route::get('recache', 'SearchController@reCache')->name('admin.search.recache');
    });
    Route::prefix('usergroups')->group(function (){
        /** Manage user groups */
        Route::get('/', 'Admin\UserGroupController@listGroups')->name('admin.usergroups.list');
        Route::post('add', 'Admin\UserGroupController@createGroup')->name('admin.usergroups.add');
        Route::get('{id}/edit', 'Admin\UserGroupController@showGroup')->name('admin.usergroups.edit');
        Route::post('{id}/edit', 'Admin\UserGroupController@updateGroup')->name('admin.usergroups.update');
        Route::get('{id}/delete', 'Admin\UserGroupController@deleteGroup')->name('admin.usergroups.delete');
        Route::post('{id}/delete', 'Admin\UserGroupController@deleteGroupConfirm')->name('admin.usergroups.deleteconfirm');
        Route::post('{id}/assignpermission', 'Admin\UserGroupPermissionsController@assignPermission')->name('admin.usergroups.permission.assign');
        Route::post('{id}/removepermission', 'Admin\UserGroupPermissionsController@unassignPermission')->name('admin.usergroups.permission.unassign');
    });
    Route::prefix('permissions')->group(function () {
        /** Manage permissions */
        Route::get('/', 'Admin\UserGroupPermissionsController@listPermissions')->name('admin.permissions.list');
        Route::get('{id}', 'Admin\UserGroupPermissionsController@showPermissions')->name('admin.permissions.view');
        Route::post('add', 'Admin\UserGroupPermissionsController@addPermission')->name('admin.permissions.add');
        //Route::get('delete', 'Admin\UserGroupPermissionsController@removePermission')->name('admin.permissions.delete');
        //Route::post('delete', 'Admin\UserGroupPermissionsController@removePermission')->name('admin.permissions.deleteconfirm');
    });
    Route::prefix('approvals')->group(function (){
        Route::get('/', 'ApprovalController@listSubmissions')->name('admin.approvals.list');
        Route::get('{id}', 'ApprovalController@showSubmission')->name('admin.approvals.view');
        Route::get('{id}/approve', 'ApprovalController@approveSubmission')->name('admin.approvals.approve');
        Route::post('{id}/approve', 'ApprovalController@approveSubmission')->name('admin.approvals.approve.confirm');
        Route::get('{id}/reject', 'ApprovalController@declineSubmission')->name('admin.approvals.reject');
    });
    Route::prefix('categories')->group(function (){
        Route::get('/', 'CategoryController@listAdminCategories')->name('admin.category.list');
        Route::get('add', 'CategoryController@showCreate')->name('admin.category.add');
        Route::post('add', 'CategoryController@create')->name('admin.category.postadd');
        Route::get('{id}', 'CategoryController@listAdminCategories')->name('admin.category.list.children');
        Route::get('{id}/edit', 'CategoryController@showUpdate')->name('admin.category.edit');
        Route::post('{id}/edit', 'CategoryController@update')->name('admin.category.postedit');
        Route::get('{id}/delete', 'CategoryController@showDelete')->name('admin.category.delete');
        Route::post('{id}/delete', 'CategoryController@remove')->name('admin.category.postdelete');
    });
});
//TODO: Adjust the route types from GET to the relevant type

Route::prefix('categories')->group(function (){
    /** Categories */
    Route::get('/', 'CategoryController@listCategories')->name('category.list');
    Route::get('{id}', 'CategoryController@listCategories')->name('category.list.children');
    Route::get('tree', 'CategoryController@listCategoryTree')->name('category.tree');
//Route::get('/categories/{id}', 'CategoryController@listGuidesInCategory')->name('category.view');
});
Route::group(['prefix' => 'guide', 'middleware' => 'auth'], function (){
    Route::get('new', 'GuideController@showCreate')->name('guide.add')->middleware('auth');
    Route::post('new', 'GuideController@submit')->name('guide.submit');
    Route::get('{id}', 'GuideController@show')->name('guide.view');
    Route::post('{id}/feedback', 'GuideController@feedback')->name('guide.feedback');
    Route::post('{id}/rate', 'GuideController@rate')->name('guide.rate');
});
Route::prefix('guides')->group(function ()
{
    Route::get('latest', 'GuideController@latest')->name('guides.latest');
    Route::get('user/{id}', 'GuideController@user')->name('guides.user');
});
Route::prefix('guidelist')->group(function () {
    Route::get('/', 'ListController@myLists')->name('guidelist.list');
    Route::post('add', 'ListController@createList')->name('guidelist.add');
    Route::get('{id}', 'ListController@showList')->name('guidelist.view');
    Route::get('{id}/update')->name('guidelist.update');
    Route::get('{id}/delete', 'ListController@removeList')->name('guidelist.deleteconfirm');
    Route::post('{id}/delete')->name('guidelist.delete');
});

Route::post('/search', 'SearchController@search')->name('search.view');
Route::get('/search/{id}', 'SearchController@searchId')->name('search.view.id');
Route::get('/test', 'HomeController@test');
