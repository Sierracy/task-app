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
        //validate

        $this->validate($request, [
            'description' => 'required',
            'assigned_to' => 'required',
            'priority' => 'required',
            'due_date' => 'required'
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
        $task->delete();

        return back();
    }

    public function showEditForm(Task $task){

        //dd($task->status);

        return view('edit', [
            'task' => $task
        ]);

    }

    public function updateTask(Request $request){
        $this->validate($request, [
            'description' => 'required',
            'assigned_to' => 'required',
            'due_date' => 'required'
        ]);

        $task = Task::find($request->id);

        //dd($request->id);

        $task->fill($request->all());
        $task->save();

        return redirect('dashboard');
    }
    
}
