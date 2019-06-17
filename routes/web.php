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

Route::get('/', function () {
    return view('welcome');
})->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//TODO: Adjust the route types from GET to the relevant type

Route::get('/admin/', 'Admin\AdminController@dashboard')->name('admin.dashboard');
Route::get('/admin/users', 'Admin\UserController@listUsers')->name('admin.users.list');
Route::get('/admin/users/{id}', 'Admin\UserController@showuser')->name('admin.users.view');
//Route::get('/admin/users/{id}/usergroups', function (){ return; })->name('admin.usersgroups.list');
Route::post('/admin/users/{id}/assigngroup', 'Admin\UserController@addMemberToGroup')->name('admin.usersgroups.assign');
Route::post('/admin/users/{id}/unassigngroup', 'Admin\UserController@removeMemberFromGroup')->name('admin.usersgroups.unassign');

/** Manage user groups */
Route::get('/admin/usergroups', 'Admin\UserGroupController@listGroups')->name('admin.usergroups.list');
Route::post('/admin/usergroups/add', 'Admin\UserGroupController@createGroup')->name('admin.usergroups.add');
Route::get('/admin/usergroups/{id}/edit', 'Admin\UserGroupController@showGroup')->name('admin.usergroups.edit');
Route::post('/admin/usergroups/{id}/edit', 'Admin\UserGroupController@updateGroup')->name('admin.usergroups.update');
Route::get('/admin/usergroups/{id}/delete', 'Admin\UserGroupController@deleteGroup')->name('admin.usergroups.delete');
Route::post('/admin/usergroups/{id}/delete', 'Admin\UserGroupController@deleteGroupConfirm')->name('admin.usergroups.deleteconfirm');

Route::get('/admin/usergroups/{id}/assignpermission', 'Admin\UserGroupController@deleteGroupConfirm')->name('admin.usergroups.permission.assign');
Route::get('/admin/usergroups/{id}/removepermission', 'Admin\UserGroupController@deleteGroupConfirm')->name('admin.usergroups.permission.unassign');

/** Manage permissions */
Route::get('/admin/permissions', 'Admin\UserGroupPermissionsController@listPermissions')->name('admin.permissions.list');
Route::get('/admin/permissions/{id}', 'Admin\UserGroupPermissionsController@showPermissions')->name('admin.permissions.view');
Route::post('/admin/permissions/add', 'Admin\UserGroupPermissionsController@addPermission')->name('admin.permissions.add');

Route::get('/admin/approvals', 'ApprovalController@listSubmissions')->name('admin.approvals.list');
Route::get('/admin/approvals/{id}', 'ApprovalController@showSubmission')->name('admin.approvals.view');
Route::get('/admin/approvals/{id}/approve', 'ApprovalController@approveSubmission')->name('admin.approvals.approve');
Route::get('/admin/approvals/{id}/reject', 'ApprovalController@declineSubmission')->name('admin.approvals.reject');


/** Categories */
Route::get('/admin/categories')->name('admin.category.list');
Route::get('/admin/categories/add', 'CategoryController@showCreate')->name('admin.category.add');
Route::post('/admin/categories/add', 'CategoryController@create')->name('admin.category.postadd');
Route::get('/admin/categories/{id}/edit', 'CategoryController@showUpdate')->name('admin.category.edit');
Route::post('/admin/categories/{id}/edit', 'CategoryController@update')->name('admin.category.postedit');
Route::get('/admin/categories/{id}/delete', 'CategoryController@showDelete')->name('admin.category.delete');
Route::post('/admin/categories/{id}/delete', 'CategoryController@remove')->name('admin.category.postdelete');

Route::get('/categories', 'CategoryController@listCategories')->name('category.list');
Route::get('/categories/{id}', 'CategoryController@listCategories')->name('category.list.children');
Route::get('/categories/tree', 'CategoryController@listCategoryTree')->name('category.tree');
//Route::get('/categories/{id}', 'CategoryController@listGuidesInCategory')->name('category.view');



Route::get('/guide/new', 'GuideController@showCreate')->name('guide.add');
Route::post('/guide/new', 'GuideController@submit')->name('guide.submit');
Route::get('/guide/{id}', 'GuideController@show')->name('guide.view');
Route::get('/guide/{id}/feedback', 'GuideController@feedback')->name('guide.feedback');
Route::post('/guide/{id}/rate', 'GuideController@rate')->name('guide.rate');


Route::get('/guidelist/')->name('guidelist.list');
Route::get('/guidelist/add')->name('guidelist.add');
Route::get('/guidelist/{id}')->name('guidelist.view');
Route::get('/guidelist/{id}/update')->name('guidelist.update');
Route::get('/guidelist/{id}/delete')->name('guidelist.delete');

Route::get('/search')->name('search.view');
