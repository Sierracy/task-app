<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request){
        //validate

        //dd($request->user()->tasks);

        $request->user()->tasks()->create([
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'assigned_to' => $request->assigned_to
            
        ]);
    
        return back();

    }

    
}
