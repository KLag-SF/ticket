<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        return view('task.form');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $groupId = $request->group_id;

        //  If the user does not have permission,
        // refuse a request with 403
        try{

            Permission::where('user_id', $userId)
                        ->where('group_id', $groupId)
                        ->firstOrFail();

        }catch(Exception $e){
            return view('error.forbidden');
        }

        $task = new Task();
        $task->user_id = $userId;
        $task->group_id = $groupId;
        $task->title = $request->title;
        $task->detail = $request->detail;
        $task-> progress = $request->progress;
        $task->save();

        // Redirect to group page
        return redirect('/group/'.$groupId);
    }
}
