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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//TODO: Adjust the route types from GET to the relevant type

Route::get('/admin/users', function (){ return; })->name('admin.users.list');
Route::get('/admin/users/{id}/usergroups', function (){ return; })->name('admin.usersgroups.list');
Route::get('/admin/users/{id}/assigngroup', function (){ return; })->name('admin.usersgroups.assign');

Route::get('/admin/usergroups', function (){ return; })->name('admin.usergroups.list');
Route::get('/admin/usergroups/add', function (){ return; })->name('admin.usergroups.add');
Route::get('/admin/usergroups/{id}/edit', function (){ return; })->name('admin.usergroups.edit');
Route::get('/admin/usergroups/{id}/delete', function (){ return; })->name('admin.usergroups.delete');

Route::get('/admin/approvals', function (){ return; })->name('admin.approvals.list');
Route::get('/admin/approvals/{id}', function (){ return; })->name('admin.approvals.view');
Route::get('/admin/approvals/{id}/approve', function (){ return; })->name('admin.approvals.approve');
Route::get('/admin/approvals/{id}/reject', function (){ return; })->name('admin.approvals.reject');


Route::get('/admin/users', function (){ return; })->name('admin.users.view');

Route::get('/guide/{id}')->name('guide.view');
Route::get('/guide/{id}/feedback')->name('guide.feedback');


Route::get('/guidelist/')->name('guidelist.list');
Route::get('/guidelist/add')->name('guidelist.add');
Route::get('/guidelist/{id}')->name('guidelist.view');
Route::get('/guidelist/{id}/update')->name('guidelist.update');
Route::get('/guidelist/{id}/delete')->name('guidelist.delete');

Route::get('/search')->name('search.view');
