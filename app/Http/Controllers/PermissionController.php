<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionController extends Controller
{
    public function show($id){
        try{
            $group = Group::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return App::abort(404);
        }
        // Join some tables to get user's name and permission by ID
        $users = Permission::where('group_id', $id)
                ->join('users', 'permissions.user_id', '=', 'users.id')
                ->join('plv', 'permissions.permission_level', '=', 'plv.level')
                ->get();

        $lv = $this->getPermissionLevel(Auth::id(), $id);
        $currentId = Auth::id();
        // resources/views/group/member.blade.php
        return view('group.member', compact('users', 'group', 'lv', 'currentId'));
    }

    public function create($id)
    {
        try{
            $group = Group::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return App::abort(404);
        }
        // resources/views/group/add.blade.php
        return view('group.add', compact('group'));
    }

    public function store(Request $request)
    {
        // If target user not found,  
        try{
            $user = User::findOrFail($request->user_id);
        }catch(Exception $e){
            return App::abort(404);
        }
        $destination = '/group/'.$request->group_id.'/member';
        // If the user already has permission for the group, do nothing and redirect.
        if ($this->getPermissionLevel($request->user_id, $request->group_id) > 0) {
            return redirect($destination);
        }
        // Make new Permission instance
        $permission = new Permission();
        // Parameters
        $permission->user_id = $request->user_id;
        $permission->group_id = $request->group_id;
        $permission->permission_level = $request->level;

        // Save
        $permission->save();
        // Redirect to member list
        return redirect($destination);
    }

    public function remove(Request $request){
        $permission_lv = $this->getPermissionLevel(Auth::id(), $request->group_id);

        if($permission_lv < 0){
            App::abort(403);
        } elseif ($request->user_id == Auth::id()) {
            // Leaders and Members can delete only themselves.
            Permission::where("user_id", Auth::id())
              ->where("group_id", $request->group_id)
              ->delete();
            return redirect('/');
        } elseif ($permission_lv <= 2) {
            // Administrators and Managers can delete all users from group.
            Permission::where("user_id", $request->user_id)
              ->where('group_id', $request->group_id)
              ->delete();
            $destination = '/group/'.$request->group_id.'/member';
            return redirect($destination);
        }
    }
}
