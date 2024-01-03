<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTask;
use App\Models\MasterTask;
use Illuminate\Support\Facades\DB;
use App\Models\User;


use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard() {
            $currentDateInIndia = Carbon::now('Asia/Kolkata');
            $final_outcome = [];
            $currentDateTime = now();
            $formattedDateTime = $currentDateTime->format('Y-m-d');
            $cl_tasks = EmployeeTask::where('user_id', auth()->user()->id)
            ->where('tracking_id', 'LIKE', 'CL%')
            ->latest()
            ->get();
            $records = [];
            $cl = 0;
            $dl = 0;
            $cl_per = 100;
            $dl_per = 100;
            $comp_cl = 0;
            $domp_dl = 0;
            $pend_cl = 0;
         $pend_dl = 0;
            foreach ($cl_tasks as $indi) {
            if (($indi->status != "NA")) {
                $cl = $cl + 1;
                $ggg = MasterTask::find($indi->task_id);
                if (($indi->status == "PARTIALLY COMPLETED") || ($indi->status == "IN PROGRESS") || ($indi->status == "PENDING")) {
                $pend_cl = $pend_cl+1;  
                $duees = $ggg->due;

                $date1 = Carbon::parse($duees);
                $date2 = Carbon::parse($formattedDateTime);
                $dayDifference = $date2->diffInDays($date1);

                if ($date1->isPast()) {
                    $cl_per = $cl_per + ($dayDifference * (-1));
                }
                } elseif ($indi->status == "FULLY COMPLETED") {
                $comp_cl = $comp_cl + 1;
                $duees = $ggg->due;
                $date1 = Carbon::parse($duees);
                $date2 = Carbon::parse($indi->updated_at);
                $dayDifference = $date2->diffInDays($date1);

                if ($dayDifference != 0) {
                    if ($date2->lt($date1)) {
                    } elseif ($date2->gt($date1)) {
                    $cl_per = $cl_per + ($dayDifference * (-1));
                    }
                }
                }
            }
            }
            $dl_tasks = EmployeeTask::where('user_id', auth()->user()->id)
            ->where('tracking_id', 'LIKE', 'DL%')
            ->latest()
            ->get();

            foreach ($dl_tasks as $indi) {
            if (($indi->status != "NA")) {
                $dl = $dl + 1;
                $ggg = MasterTask::find($indi->task_id);
                if (($indi->status == "PARTIALLY COMPLETED") || ($indi->status == "IN PROGRESS") || ($indi->status == "PENDING")) {
                    $pend_dl = $pend_dl + 1; 
                $duees = $ggg->due;
                $date1 = Carbon::parse($duees);
                $date2 = Carbon::parse($formattedDateTime);
                $dayDifference = $date2->diffInDays($date1);
                if ($date1->isPast()) {
                    $dl_per = $dl_per + ($dayDifference * (-1));
                }
                } elseif ($indi->status == "FULLY COMPLETED") {
                $domp_dl = $domp_dl + 1;
                $duees = $ggg->due;
                $date1 = Carbon::parse($duees);
                $date2 = Carbon::parse($indi->updated_at);
                $dayDifference = $date2->diffInDays($date1);

                if ($dayDifference != 0) {
                    if ($date2->lt($date1)) {
                    } elseif ($date2->gt($date1)) {

                    $dl_per = $dl_per + ($dayDifference * (-1));
                    }
                }
                }
            }
            }
            $final_outcome["total_Cl_Alloted"] = $cl;
            $final_outcome["total_Cl_Completed"] = $comp_cl;
            $final_outcome["total_Pending_Cl"] = $cl - $comp_cl;
            $final_outcome["total_delay_Cl"] = $pend_cl;
            $final_outcome["total_delay_Dl"] = $pend_dl;
            $final_outcome["score_Cl"] = $cl_per;
            $final_outcome["total_Dl_Alloted"] = $dl;
            $final_outcome["total_Dl_Completed"] = $domp_dl;
            $final_outcome["total_Pending_Dl"] = $dl - $domp_dl;
            $final_outcome["score_Dl"] = $dl_per;

            if(auth()->user()->role == 1){
                $valls = DB::table('employee_tasks')
                ->join('master_tasks', 'employee_tasks.task_id', '=', 'master_tasks.id')
                ->join('users','users.id','=','master_tasks.assigned_by')
                ->join('users as ussu','ussu.id','=','master_tasks.assigned_id')
                ->select('employee_tasks.*', 'master_tasks.*','users.name as assigner','ussu.name as doer') // Select columns as needed
                ->get();
            }elseif(auth()->user()->role == 2){
                $valls = DB::table('employee_tasks')
                ->join('master_tasks', 'employee_tasks.task_id', '=', 'master_tasks.id')
                ->join('users','users.id','=','master_tasks.assigned_by')
                ->where('master_tasks.created_by',auth()->user()->id)
                ->join('users as ussu','ussu.id','=','employee_tasks.user_id')
                ->select('employee_tasks.*', 'master_tasks.*','users.name as assigner','ussu.name as doer')
                ->get();
            }
           

    $final_outcome['taskdet'] = $valls;
    
    $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." has browsed the dashboard page at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
    

        return view("dashboard", ["records" => $final_outcome]);
    }
}
