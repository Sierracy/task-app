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
            'description' => 'required|unique|max:200', //spit out 'task is assigned'
            'assigned_to' => 'required|max:100',
            'priority' => 'required',
            'due_date' => 'required|date|after_or_equal:today'
        ]);        

        $request->user()->tasks()->create([
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'assigned_to' => $request->assigned_to
            
        ]);
    
        return back();

    }

    public function destroy(Task $task)
    {
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
        $this->validate($request, [
            'description' => 'required|unique|max:200',
            'assigned_to' => 'required|max:100',
            'due_date' => 'required|date|after_or_equal:today'
        ]);

        $task = Task::find($request->id);
        $task->fill($request->all());
        $task->save();

        return redirect('dashboard');
    }
    
}
