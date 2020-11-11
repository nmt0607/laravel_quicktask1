<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller {

    function userList() 
    {
        return view('users', [
            'users' => User::orderBy('created_at', 'asc')->get()
        ]);
    }

    function userDetail($id) 
    {
        $user = User::findOrFail($id);
        $task_user = $user->tasks()->get();
        $task = Task::all();
        $task_list = $task->diff($task_user);
        return view('userDetail', [
            'user' => $user,
            'tasks' => $task_user
        ]);
    }

    function addNewUser(Request $request) 
    {
        $user = new User;
        $user->name = $request->name;
        $user->save();
        return redirect('userList');
    }

    function deleteUser($id) 
    {
        DB::table('task_user')->where('user_id','=',$id)->delete();
        User::findOrFail($id)->delete();
        return redirect('userList');
    }

    function listTaskCanAdd($id) 
    {
        $users = User::findOrFail($id);
        $task_user = $users->tasks()->get();
        $task = Task::all();
        $task_list = $task->diff($task_user);
        return view('addTaskUser', [
            'users' => $users,
            'tasks' => $task_list
        ]);
    }

    function addTaskToUser($id) 
    {
        if (isset($_GET["task"])) {
            $user = User::find($id);
            $user->tasks()->attach($_GET["task"]);
            return redirect('userDetail/' . $id);
        } else
            return redirect('userDetail/' . $id);
    }

    function removeTaskFromUser($id) 
    {
        $user = User::find($id);
        $user->tasks()->detach($_GET["task_id"]);
        return redirect('userDetail/' . $id);
    }
}
