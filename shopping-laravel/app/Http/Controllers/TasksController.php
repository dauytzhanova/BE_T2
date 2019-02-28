<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class TasksController extends Controller
{
    //
    public function index(){
        $tasks = \App\Task::incomplete();
        return view('tasks',compact('tasks'));
    }
    public function show($id){
        $task = \App\Task::find($id);
        return view('show',compact('task'));
    }

}
