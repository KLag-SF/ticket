<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PermissionController extends Controller
{
    public function show($id){
        try{
            $group = Group::findOrFail($id);
        }catch(Exception $e){
            return App::abort(404);
        }
        // Join some tables to get user's name and permission by ID
        $users = Permission::where('group_id', $id)
                ->join('users', 'permissions.user_id', '=', 'users.id')
                ->join('plv', 'permissions.permission_level', '=', 'plv.level')
                ->get();
        // resources/views/group/member.blade.php
        return view('group.member', compact('users', 'group'));
    }

    public function create($id)
    {
        try{
            $group = Group::findOrFail($id);
        }catch(Exception $e){
            return App::abort(404);
        }
        // resources/views/group/add.blade.php
        return view('group.add', compact('group'));
    }

    public function store(Request $request)
    {
        // Make new Permission instance
        $permission = new Permission();

        // If target user not found, show toast  
        try{
            User::findOrFail($request->user_id);
        }catch(Exception $e){
            return view('error.notFound');
        }

        // Parameters
        $permission->user_id = $request->user_id;
        $permission->group_id = $request->group_id;
        $permission->permission_level = $request->level;

        // Save
        $permission->save();
        // Redirect to member list
        $destination = '/group/'.$request->group_id.'/member';
        return redirect($destination);
    }
}
