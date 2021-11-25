<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Permission;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create($id)
    {
        return view('task.form', ['id'=>$id]);
    }

    public function store(Request $request, $id)
    {
        $userId = Auth::id();
        $groupId = $id;

        //  If the user does not have permission,
        // refuse a request with 403
        try{
            Permission::where('user_id', $userId)
                        ->where('group_id', $groupId)
                        ->firstOrFail();
        }catch(Exception $e){
            return view('error.forbidden');
        }

        //parameters...
        $task = new Task();
        $task->user_id = $userId;
        $task->group_id = $groupId;
        $task->title = $request->title;
        $task->detail = $request->detail;
        $task->limit = $request->limit;
        $task-> progress = $request->progress;
        $task->save();

        // Redirect to group page
        return redirect('/group/'.$groupId);
    }
    public function show(Request $request, $id){
        try{
            $task = Task::findOrFail($id);
        }catch(Exception $e){
            // If a exception was returned, redirect to 404 error page
            App::abort(404);
        }
        // Get the group's task list
        return view('task.index', compact('task'));
    }
}
