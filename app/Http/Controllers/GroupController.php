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
use Illuminate\Support\Facades\Log;

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
        if ($this-> getPermissionLevel(Auth::id(), $group) > 0) {
            return view();
        }
    }

    public function show($id, Request $request)
    {
        if($this -> getPermissionLevel(Auth::id(), $id) > 0){
            try{
                $group = Group::findOrFail($id);
            }catch(Exception $e){
                // If a exception was returned, redirect to 404 error page
                App::abort(404);
            }
            // Get the group's task list
            $tasks = Task::where('group_id', $id);
            if ($request -> orderby == 'title') {
                $tasks = $tasks -> orderBy('title', 'asc');
            }
            $tasks = $tasks->get();
            return view('group.index', compact('group', 'tasks'));
        }else{
            // If the user doesn't have a permission, return "error" view
            return view('error.forbidden');
        }
    }
}
