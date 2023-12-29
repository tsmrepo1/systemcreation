<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTask;
use App\Models\EmployeeTaskHistory;
use App\Models\MasterTask;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $currentDateInIndia = Carbon::now('Asia/Kolkata');
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
$user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." has browsed the task page at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
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
         $currentDateInIndia = Carbon::now('Asia/Kolkata');
        
        $record = EmployeeTask::find($id);
        $record->status = $request->status;
        $record->save();

        EmployeeTaskHistory::create([
            "employee_task_id" => $record->id,
            "status"           => $record->status
        ]);
        
          $recipients = ['tamoghna@thinksurfmedia.info', 'raktim@thinksurfmedia.info'];
            
            $deet = MasterTask::join('users', 'users.id', '=', 'master_tasks.assigned_by')->join('users as uss', 'uss.id', '=', 'master_tasks.assigned_id')->select('master_tasks.*','users.name as Naam','uss.name as Doer','employee_tasks.tracking_id')
                ->join('employee_tasks', 'employee_tasks.task_id', '=', 'master_tasks.id')
                ->where('master_tasks.id', $id)
                ->first();
                
                
            
            $html = "<table style='border-collapse: collapse; width: 100%;'><thead><tr><th style='border: 1px solid black;'>Tracking ID.</th><th style='border: 1px solid black;'>PROJECT ID</th><th style='border: 1px solid black;'>TASK NAME</th><th style='border: 1px solid black;'>DESCRIPTION</th><th style='border: 1px solid black;'>PLANNED DATE</th><th style='border: 1px solid black;'>FOR COMPANY</th><th style='border: 1px solid black;'>Assigned By</th><th style='border: 1px solid black;'>Assigned To</th><th style='border: 1px solid black;'>Current Status Changed</th><th style='border: 1px solid black;'>Created</th></tr></thead><tbody><tr><td style='border: 1px solid black;'>".htmlspecialchars($deet->tracking_id)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->tracking_id)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->name)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->description)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->due)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->for_company)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->Naam)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->Doer)."</td><td style='border: 1px solid black;'>".htmlspecialchars($request->status)."</td><td style='border: 1px solid black;'>".htmlspecialchars($deet->assigned_date)."</td></tr></tbody></table>";
         Mail::send([], [], function ($message) use ($recipients, $html) {
    $message->to($recipients)
            ->subject('Task Status Has Been Changed')
            ->html($html); // Set your HTML content here
});

    $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." has changed the task status at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
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
