<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\MasterTask;
use App\Models\EmployeeTask;
use Illuminate\Support\Facades\DB;
use App\Models\User;


use Illuminate\Support\Facades\Json;

class LiveviewController extends Controller
{

  public function index()
  {
    
    $users = User::all();
   
    foreach($users as $user){
      $together[] = [
      'id' => $user->id,  
      'Name' => $user->name,
      'Assigned_Task' => MasterTask::where('assigned_id', $user->id)->count(),
      'Running_Task' => MasterTask::where('assigned_id', $user->id)
      ->join('employee_tasks', function($join) { 
      $join->on('employee_tasks.task_id', '=', 'master_tasks.id');
      })
      ->where('employee_tasks.status', 'IN PROGRESS')
      ->count()
      ];
      }
     
    return view("pages.employee_task.running", ["records" => $together]);
  }

  public function showrunning(Request $request){

    $mrr = MasterTask::where('assigned_id', $request->id)
    ->join('employee_tasks', function($join) {
        $join->on('employee_tasks.task_id', '=', 'master_tasks.id');
    })
    ->where('employee_tasks.status', 'IN PROGRESS')
    ->get();

    return response()->json(['allrun' => $mrr]);
  }

  public function revupdate(){
      
       $currentDateInIndia = Carbon::now('Asia/Kolkata');

    $record = DB::table('employee_tasks')
    ->join('master_tasks', 'employee_tasks.task_id', '=', 'master_tasks.id')
    ->join('users', 'users.id', '=', 'employee_tasks.user_id')
    ->join('users as ussa', 'ussa.id', '=', 'master_tasks.assigned_by')
    ->select('employee_tasks.updated','employee_tasks.id','employee_tasks.tracking_id','master_tasks.name','master_tasks.description','employee_tasks.due','master_tasks.for_company','ussa.name as Naam','users.name as doer')
    ->get();
    
     $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." has opened the page to update the deadline of any project for someone at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
     //dd($record);
    return view("pages.master_task.deleupdate", ["records" => $record]);
  }
 
  public function doupdate(Request $request, $id){

 $currentDateInIndia = Carbon::now('Asia/Kolkata');
    DB::table('employee_tasks')
    ->where('id', $id)
    ->update([
        'updated' => DB::raw('updated + 1'),
        'due' => $request->datedd,
    ]);
    
    $resultngg = DB::table('employee_tasks')
    ->join('master_tasks', 'employee_tasks.task_id', '=', 'master_tasks.id')
    ->join('users', 'users.id', '=', 'employee_tasks.user_id')
    ->select('master_tasks.*','users.name as Naam')
    ->where('employee_tasks.id', '=', $id) // Replace 'column_name' with the column you want to filter and 'value' with the filter value
    ->get();

    $record = DB::table('employee_tasks')
    ->join('master_tasks', 'employee_tasks.task_id', '=', 'master_tasks.id')
    ->join('users', 'users.id', '=', 'employee_tasks.user_id')
    ->join('users as ussa', 'ussa.id', '=', 'master_tasks.assigned_by')
    ->select('employee_tasks.updated','employee_tasks.id','employee_tasks.tracking_id','master_tasks.name','master_tasks.description','employee_tasks.due','master_tasks.for_company','ussa.name as Naam','users.name as doer')
    ->get();
    
     $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." has updated the task, ".$resultngg->name.", for the employee,".$resultngg->Naam." at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
  
    return view("pages.master_task.deleupdate", ["records" => $record]);
  }
  
  public function userslog(){
      $alllog = DB::table('master_log')->join('users','users.id','=','master_log.user_id')->get();
      return view("pages.employee_task.logview", ["records" => $alllog]);
      
  }

  

  
}
