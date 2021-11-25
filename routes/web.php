<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Root redirect
Route::get('/', function (){
    return redirect('/home');
});

// User home
Route::resource('/home', 'UserPageController')->middleware('verified');

// Group create page
Route::get('/group/create', 'GroupController@create');
// Create new group(POST)
Route::post('/group', 'GroupController@store');
// Group main page
Route::get('/group/{id}', 'GroupController@show');
// Group edit page
Route::get('/group/{id}/edit', 'GroupController@edit');
// Group Rename API
Route::post('/group/{id}/edit', 'GroupController@rename');
// Group Delete API
Route::delete('/group/{id}', 'GroupController@delete');
// Group's member list
Route::get('/group/{id}/member', 'PermissionController@show');
// Add new member page
Route::get('/group/{id}/member/add', 'PermissionController@create');
// Remove user from the group
Route::post('/group/{id}/member/remove', 'PermissionController@remove');
// Create new permission process
Route::post('/permission', 'PermissionController@store');

// Page for new task form
Route::get('/group/{id}/ticket', 'TaskController@create')->middleware('verified');
// Create new ticket
Route::post('/group/{id}/ticket', 'TaskController@store');

// Task detail page
Route::get('/task/{id}/', 'TaskController@show')->middleware('verified');

// Logout process
Route::get('/logout',function ($request){
   Auth::logout();
   $request->session()->invalidate();
   $request->session()->regenerateToken();
   return redirect('/login');
});

/*-----------------------------------------
| Following routes are used for debugging. |
------------------------------------------*/

Route::get('/403', function(){
    return view('error.forbidden');
});

Route::get('/404', function(){
    return view('error.userNotFound');
});