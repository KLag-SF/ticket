<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    public function index(){
        $user = User::findOrFail(Auth::id());
        $permissions = Permission::where('user_id', Auth::id())->get();
        $groups = $permissions->join('groups', 'permissions.group_id', '=', 'groups.id')
                            ->join('plv', 'permissions.level', '=', 'plv.level')
                            ->get();
        return view('user/index', compact('user', 'groups'));
    }
}