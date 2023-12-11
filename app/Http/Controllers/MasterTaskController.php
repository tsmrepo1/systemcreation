<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTask;
use App\Models\MasterTask;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;

class MasterTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records    = MasterTask::latest()->get();
        $tasks      = [];
        
        foreach($records as $record) {
            $data =  [
                "name"             => $record->name,
                "description"      => $record->description,
                "due"              => date("d-m-Y", strtotime($record->due)),
                "assigned_date"    => date("d-m-Y", strtotime($record->assigned_date)),
                "frequency"        => $record->frequency,
                "created_by"       => User::find($record->created_by),
                "assigned_by"      => User::find($record->assigned_by),
                "assigned_to"      => $record->assigned_to,
                "assigned_id"      => []
            ];

            $assigned_id = explode(",", $record->assigned_id);
            foreach($assigned_id as $id) {
                $data["assigned_id"][] = User::find($id);
            }

            $tasks[] = $data;
        }

        return response()->json(["status" => true, "tasks" => $tasks], 200);
    }

    public function create()
    {
        $users = User::all();
        $teams = Team::all();
        $super_admins = User::where("role", 1)->get();

        return view("pages.master_task.create", ["users" => $users, "teams" => $teams, "super_admins" => $super_admins]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $task = new MasterTask();
        $task->name             = $request->name;
        $task->description      = $request->description;
        $task->due              = $request->due;
        $task->assigned_date    = $request->assigned_date;
        $task->for_company    =   $request->for_company;
        $task->frequency        = $request->frequency;
        $task->created_by       = auth()->user()->id;
        $task->assigned_by      = $request->assigned_by;
        $task->assigned_to      = $request->assigned_to;
        $task->assigned_id      = $request->assigned_to == "TEAM" ? implode(",", $request->assigned_team_id) : implode(",", $request->assigned_individual_id);

        
        if($task->save()) {
            if($task->assigned_to == "INDIVIDUAL") {
                $ids = explode(",", $task->assigned_id);

                foreach($ids as $id) {
                   
                    EmployeeTask::create([
                        "user_id"       => $id,
                        "tracking_id"   => $this->get_next_tracking_id($request->frequency),
                        "due"           => $request->due,
                        "task_type"     => $request->frequency == "ONE TIME" ? "DELEGATION" : "CHECKLIST",
                        "task_id"       => $task->id
                    ]);
                }
            }

            if ($task->assigned_to == "TEAM") {
                $ids = explode(",", $task->assigned_id);

                foreach ($ids as $id) {
                    $teamMembers = TeamMember::where("team_id", $id)->get();
                        
                    foreach($teamMembers as $teamMember) {
                        EmployeeTask::create([
                            "user_id"       => $teamMember->id,
                            "tracking_id"   => $this->get_next_tracking_id($request->frequency),
                            "task_type"     => $request->frequency == "ONE TIME" ? "DELEGATION" : "CHECKLIST",
                            "task_id"       => $task->id
                        ]);
                    }
                }                    
            }

            $request->session()->flash('success', 'New task has been created');
            return redirect()->back();
        }
        else {
            $request->session()->flash('error', 'New task creation failed');
            return redirect()->back();
        }
    }

    public function get_next_tracking_id($task_type)
    {
       
        $type      = $task_type == "ONE TIME" ? "DELEGATION" : "CHECKLIST";
        
        $last_id   = EmployeeTask::select("tracking_id")
                                    ->where("task_type", $type)
                                    ->orderBy("id", "DESC")->first();
        
        if ($last_id) {
            $current_no = explode("-", $last_id)[1];
        } else {
            $current_no = 0;
        }
        
        $current_no         = (int)$current_no;
        $next_receipt_no    = $current_no + 1;

        $prefix = $type == "CHECKLIST" ? "CL-" : "DL-";

        return $prefix . $next_receipt_no;
    }
        
    /**
     * Display the specified resource.
     */
    public function show(MasterTask $masterTask)
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterTask $masterTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterTask $masterTask)
    {
        //
    }
}
