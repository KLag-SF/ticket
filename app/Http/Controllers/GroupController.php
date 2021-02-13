<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index(){
        return view('group.index');
    }

    public function store(Request $request){
        $group = new Group();
        $permission = new Permission();

        $group->group_name = $request->name;
        $group->save();

        $permission->user_id = Auth::id();
        $permission->group_id = DB::table('groups')->max('id');
        $permission->permission_level = 1;
        $permission->save();

        return redirect('/home');
    }

    public function create(){
        return view('group.create');
    }
}
