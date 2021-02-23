<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Task;
# use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function store(Request $request){
        // Make new Group, Permission instance
        $group = new Group();
        $permission = new Permission();

        // Save group name.
        $group->group_name = $request->name;
        $group->save();

        // Set the user as administrator of the group
        $permission->user_id = Auth::id();
        // This process may work wrongly under heavy traffics
        $permission->group_id = DB::table('groups')->max('id');
        $permission->permission_level = 1;
        $permission->save();

        // Redirect to created group page
        return redirect('/group/'.$permission->group_id);
    }

    public function create(){
        // resources/views/group/create.blade.php
        return view('group.create');
    }

    public function edit($group)
    {
        if ($this->hasPermission($group)) {
            return view();
        }
    }

    public function show($id)
    {
        if($this->hasPermission($id)){
            try{
                $group = Group::findOrFail($id);
            }catch(Exception $e){
                // If a exception was returned, redirect to 404 error page
                App::abort(404);
            }
            // Get the group's task list
            $tasks = Task::where('group_id', $id)->get();
            return view('group.index', compact('group', 'tasks'));
        }else{
            // If the user doesn't have a permission, return "error" view
            return view('error.forbidden');
        }
    }

    // Check if the user has permission to access group whose id matches $groupId
    public function hasPermission($groupId){
        $userId = Auth::id();
        try{
            // firstOrFail() method returns a exception when nothing has found 
            Permission::where('user_id', $userId)
                        ->where('group_id', $groupId)
                        ->firstOrFail();
        }catch(Exception $e){
            // When catch a exception, user doesn't have a permission
            return false;
        }
        return true;
    }
}
