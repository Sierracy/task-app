<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
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

    
}
