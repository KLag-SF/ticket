<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function create($id)
    {
        $task = new Task();
        return view('task.create', compact('id', 'task'));
    }

    public function edit($id){
        try {
            $task = Task::findOrFail($id);
        } catch (ModelNotFoundException $e){
            App::abort(404);
        }

        $lv = $this->getPermissionLevel(Auth::id(), $task->group_id);
        if (($lv > 0 && $lv <= 2) || (Auth::id() == $task->user_id)){
            return view('task.update', compact('task'));
        } else {
            App::abort(403);
        }
    }

    public function store(Request $request, $id)
    {
        //  If the user does not have permission,
        // refuse a request with 403
        if ($this->getPermissionLevel(Auth::id(), $id) < 0){
            App::abort(403);
        }

        //parameters...
        $task = new Task();
        $task->user_id = Auth::id();
        $task->group_id = $id;
        $task->title = $request->title;
        $task->detail = $request->detail;
        $task->limit = $request->limit;
        $task->progress = $request->progress;
        $task->save();

        // Redirect to group page
        return redirect('/group/'.$id);
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

    public function update(Request $request, $id){
        try {
            $task = Task::findOrFail($id);
        } catch (ModelNotFoundException $e){
            App::abort(404);
        }
        $lv = $this->getPermissionLevel(Auth::user(), $task->group_id);
        // The owner of tasks or Administrators/Managers can edit them
        if (($lv <= 2 && $lv > 0) || (Auth::id() == $task->user_id)){
            $task->user_id = Auth::id();
            $task->group_id = $id;
            $task->title = $request->title;
            $task->detail = $request->detail;
            $task->limit = $request->limit;
            $task->progress = $request->progress;
            $task->save();
            return redirect('/group/'.$task->group_id);
        } else {
            App::abort(403);
        }
    }

    public function delete($id){
        try {
            $task = Task::findOrFail($id);
        } catch (ModelNotFoundException $e){
            App::abort(404);
        }
        $group_id = $task->group_id;
        $lv = $this->getPermissionLevel(Auth::user(), $group_id);

        if (($lv <= 2 && $lv > 0) || (Auth::id() == $task->user_id)){
            $task->delete();
            return redirect('/group/'.$group_id);
        } else {
            App::abort(403);
        }
    }
}
