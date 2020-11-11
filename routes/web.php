<?php

use Illuminate\Support\Facades\Route;
//use App;
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */



Route::group(['middleware' => ['web']], function () {

    // Show Task Dashboard

    Route::get('taskList', 'TaskController@taskList')->name('taskList');

    // Show Task Info

    Route::get('taskDetail/{id}', 'TaskController@taskDetail')->name('taskDetail');

    // Add New Task

    Route::post('task', 'TaskController@addNewTask')->name('task');

    // Detele Task

    Route::delete('task/{id}', 'TaskController@deleteTask')->name('deleteTask');

    // List User Can Add To Task

    Route::get('listUserCanAdd/{id}', 'TaskController@listUserCanAdd')->name('listUserCanAdd');

    // Add User To Task

    Route::get('addUserToTask/{id}', 'TaskController@addUserToTask')->name('addUserToTask');

    // Remove User from Task

    Route::get('removeUserFromTask/{id}', 'TaskController@removeUserFromTask')->name('removeUserFromTask');

    // Show User Dashboard

    Route::get('userList', 'UserController@userlist')->name('userList');

    // Show User Info

    Route::get('userDetail/{id}', 'userController@userDetail')->name('userDetail');

    // Add New User

    Route::post('user', 'UserController@addNewUser')->name('user');

    // Detele User

    Route::delete('user/{id}', 'UserController@deleteUser')->name('deleteUser');

    // List Task Can Add To User

    Route::get('listTaskCanAdd/{id}', 'UserController@listTaskCanAdd')->name('listTaskCanAdd');

    // Add Task To User

    Route::get('addTaskToUser/{id}', 'UserController@addTaskToUser')->name('addTaskToUser');

    // Remove Task From User

    Route::get('removeTaskFromUser/{id}', 'UserController@removeTaskFromUser')->name('removeTaskFromUser');

    Route::get('welcome/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
});
