<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTask;
use App\Models\EmployeeTaskHistory;
use App\Models\MasterTask;
use Illuminate\Http\Request;
use DB;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = EmployeeTask::where("user_id", auth()->user()->id)->latest()->get();
        $records = [];
        
        foreach($tasks as $task) {
            if($task->task_type == "DELEGATION" || $task->task_type == "CHECKLIST") {
                $task->task = MasterTask::join('users', 'users.id', '=', 'master_tasks.assigned_by')->select('master_tasks.*','users.name as Naam')
                ->where('master_tasks.id', $task->task_id)
                ->first();
                $records[] = $task;
            }
        }

        return view("pages.employee_task.index", ["records" => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeTask $employeeTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeTask $employeeTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $record = EmployeeTask::find($id);
        $record->status = $request->status;
        $record->save();

        EmployeeTaskHistory::create([
            "employee_task_id" => $record->id,
            "status"           => $record->status
        ]);

        $request->session()->flash('success', 'Task Status Updated.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeTask $employeeTask)
    {
        //
    }
}
