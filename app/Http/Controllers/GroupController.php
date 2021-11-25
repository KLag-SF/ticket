<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function edit($id, Request $request)
    {
        try {
            $group = Group::findOrFail($id);
        } catch (ModelNotFoundException $e){
            App::abort(403);
        }

        if ($this-> getPermissionLevel(Auth::id(), $id) == 1) {
            return view('group.edit', compact('group'));
        } else {
            App::abort(403);
        }
    }

    public function show($id, Request $request)
    {
        $lv = $this->getPermissionLevel(Auth::id(), $id);
        if($lv > 0){
            try{
                $group = Group::findOrFail($id);
            }catch(ModelNotFoundException $e){
                // If a exception was returned, redirect to 404 error page
                App::abort(404);
            }
            // Get the group's task list
            $tasks = Task::where('group_id', $id);
            if ($request -> orderby == 'title') {
                $tasks = $tasks -> orderBy('title', 'asc');
            }
            $tasks = $tasks->get();
            return view('group.index', compact('group', 'tasks', 'lv'));
        }else{
            // If the user doesn't have a permission, return "error" view
            return view('error.forbidden');
        }
    }
    public function rename($id, Request $request){
        $lv = $this->getPermissionLevel(Auth::id(), $id);
        if ($lv == 1){
            try {
                $group = Group::findOrFail($id);
                $group->group_name = $request->group_name;
                $group->save();
            } catch(ModelNotFoundException $e){
                App::abort(404);
            }
            return redirect('/group/'.$id);
        }else{
            App::abort(403);
        }
    }
}
