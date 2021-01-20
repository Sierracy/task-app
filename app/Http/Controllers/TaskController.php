<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        $tasks = Task::get();
        
        return view('dashboard', [
            'tasks' => $tasks
        ]);
    }

    public function store(Request $request){

        $this->validate($request, [
            //Users can assign the same task description to multiple team members
            //A task is a duplicate when the same description/assigned_to pair exists in the database
            'description' => 'required|unique:tasks,description,NULL,NULL,assigned_to,'.$request->assigned_to.'|max:200', //spit out 'task is assigned'
            'assigned_to' => 'required|max:100',
            'priority' => 'required',
            'due_date' => 'required|date|after_or_equal:today'
        ]);        

        $request->user()->tasks()->create([

            //status always defaults to pending on create
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'assigned_to' => $request->assigned_to
            
        ]);
    
        return back();

    }

    public function destroy(Task $task)
    {
        //TODOtryCatch find or fail
        $trashTask = Task::find($task->id);

        if($trashTask){
            $task->delete();
        }

        else{
            
            dd($task);
        }
  
        return back();
    }

    public function showEditForm(Task $task){

        return view('edit', [
            'task' => $task
        ]);

    }

    public function updateTask(Request $request){
        
        //TODO try catch find or fail
        $task = Task::find($request->id);

        $this->validate($request, [

            //required to prevent submission of empty string on update
            //form automatically filled with old value     
            'description' => 'required|unique:tasks,description,'.$request->id.'max:200',

            //required to prevent submission of empty string on update
            //form automatically filled with old value
            'assigned_to' => 'required|max:100',

            //if a new due date is submitted, it must be in date format and be >= today's date
            'due_date' => 'exclude_if:due_date,'.$task->due_date.'|required|date|after_or_equal:today'
        ]);

        
        $task->fill($request->all());
        $task->save();

        return redirect('dashboard');
    }
    
}
