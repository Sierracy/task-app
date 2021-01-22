<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    /*
    * @desc Query the database for all tasks and order the results by latest updated.
    * @param 
    * @return return the dashboard view with the query results
    */
    public function create()
    {

        $tasks = Task::orderBy('updated_at', 'DESC')->paginate(4);
        
        return view('dashboard', [
            'tasks' => $tasks
        ]);

    }

    /*
    * @desc validates information submitted from form before creating and saving a task
    * @param a request including a task model
    * @return redirect to dashboard
    */
    public function store(Request $request)
    {

        $this->validate($request, [

            //Users can assign the same task description to multiple team members
            //A task is a duplicate when the same description/assigned_to pair exists in the database
            'description' => 'required|unique:tasks,description,NULL,NULL,assigned_to,'.$request->assigned_to.'|max:200', 
            'assigned_to' => 'required|max:100',
            'priority' => 'required',
            'due_date' => 'required|date|after_or_equal:today'

        ]);        

        $request->user()->tasks()->create([

            //status will default to 'Pending' on create
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'assigned_to' => $request->assigned_to
            
        ]);
    
        return back();

    }

    /*
    * @desc checks that a task exists and if so deletes that task
    * @param a task model
    * @return redirect to dashboard, redirect with error message on failure
    */
    public function destroy(Task $task)
    {
    
        $trashTask = Task::find($task->id);

        if($trashTask){
            $task->delete();
        }

        else{        
            return back()->withErrors(['msg', 'Task does not exist']);
        }
  
        return back();
    }


    /*
    * @desc view the form to edit a task
    * @param aa task model
    * @return the edit task view
    */
    public function showEditForm(Task $task)
    {

        return view('edit', [
            'task' => $task
        ]);

    }

    /*
    * @desc checks that a task exists then updates with information from the request
    * @param a request including a task model
    * @return redirect to dashboard
    */
    public function updateTask(Request $request)
    {
        
        $task = Task::find($request->id);

        $this->validate($request, [

            //required to prevent submission of empty string on update
            //form automatically filled with old value     
            'description' => 'required|unique:tasks,description,'.$request->id.'max:200',

            //disabled on form
            //rule included for future admin update
            'assigned_to' => 'max:100',

            //if a new due date is submitted, it must be in date format and be >= today's date
            'due_date' => 'exclude_if:due_date,'.$task->due_date.'|required|date|after_or_equal:today'

        ]);

        
        $task->fill($request->all());
        $task->save();

        return redirect('dashboard');
    }
    
}
