<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use DB;

class TaskController extends Controller
{
    function taskList()
    {
    	return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    }

    function taskDetail($id) 
    {
        $task = Task::findOrFail($id);
        $userBelongsTo = $task->users()->get();
        return view('taskDetail', [
            'task' => $task,
            'users' => $userBelongsTo
        ]);
    }

    function addNewTask(Request $request) 
    {
        $task = new Task;
        $task->name = $request->name;
        $task->save();
        return redirect('taskList');
    }

    function deleteTask($id)
    {
        DB::table('task_user')->where('task_id','=',$id)->delete();
        Task::findOrFail($id)->delete();
        return redirect('taskList');
    }

    function listUserCanAdd($id) 
    {
        $tasks = Task::findOrFail($id);
        $userBelongsTo = $tasks->users()->get();
        $user = User::all();
        $userDontBelongsTo = $user->diff($userBelongsTo);
        return view('addUserTask', [
            'tasks' => $tasks,
            'users' => $userDontBelongsTo
        ]);
    }

    function addUserToTask($id)
    {
        if (isset($_GET["user"])) {
            $task = Task::find($id);
            $task->users()->attach($_GET["user"]);
            return redirect('taskDetail/' . $id);
        } else
            return redirect('taskDetail/' . $id);
    }

    function removeUserFromTask($id) 
    {
        $task = Task::find($id);
        $task->users()->detach($_GET["user_id"]);
        return redirect('taskDetail/' . $id);
    }
}
