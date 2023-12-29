<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDateInIndia = Carbon::now('Asia/Kolkata');
        $rolls = DB::select('SELECT id,role_name FROM roles');
         $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." has open the page to create any role at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
        return response()->json($rolls, 200);
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
        $currentDateInIndia = Carbon::now('Asia/Kolkata');
        $validator = Validator::make($request->all(), [
            'role_name' => 'required',
            'role_description' => 'required',
            
        ]);
        if ($validator->fails()) {
            $response = ["message" => 'Mandetory Fields Are Missing'];
            return json_encode($response);
        }else{
            $result = DB::select('SELECT * FROM roles WHERE role_name = ?', [$request->role_name]);
            if(sizeof($result)>0){
                $response = ["message" => 'This Role Name Already Present in The Collection.'];
                return json_encode($response);
            }else{
                $team = new Role();
                $team->fill([
                    'role_name' => $request->role_name,
                    'role_description' => $request->role_description,
                    
                ]);
                if($team->save()){
                     $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." has create a role (".$request->role_name.") at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
                    $response = ["message" => 'A New Role Has Been Created Successfully.'];
                    return json_encode($response);
                }else{
                    $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." was trying to create a role, but was not successful due to some technical issue, at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
                    $response = ["message" => 'Some Technical Difficulties Has Been Happened.'];
                    return json_encode($response);   
                }
            }
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $currentDateInIndia = Carbon::now('Asia/Kolkata');
        $list["users"] = array();
        $result = DB::select('SELECT * FROM roles WHERE id = ?', [$id]);
        $members = explode(',', $result[0]->user_ids);
        foreach($members as $values){
            $mem=[];
            $resultn = DB::select('SELECT * FROM users WHERE id = ?', [$values]);
            $mem["id"]=$resultn[0]->id;
            $mem["name"]=$resultn[0]->name;
            array_push( $list["users"],$mem);
        }
        $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." want to check details of role, ".$result[0]->role_name.", at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
        return response()->json($list, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $currentDateInIndia = Carbon::now('Asia/Kolkata');
        $resultn = DB::select('SELECT * FROM roles WHERE id = ?', [$id]);
        $X = $resultn[0]->user_ids;
        $csvString = implode(',', $request->users);
        $nemsec = DB::table('users')
    ->whereIn('id', $request->users)
    ->pluck('name')
    ->toArray();
    $mollas= implode(',', $nemsec);
        if($X==""){
            DB::table('roles')
            ->where('id', $id)
            ->update([
                'user_ids' => $csvString,
                
            ]); 
        }else{
         $compact = $X.",".$csvString;  
         DB::table('roles')
            ->where('id', $id)
            ->update([
                'user_ids' => $compact,
                
            ]);  
        }
         $user = User::find(auth()->user()->id);
    $naam = $user->name;
    $formattedDate = $currentDateInIndia->format('Y-m-d H:i:s');
    $logg = $naam." is assigning, ".$mollas." to the role,".$resultn[0]->role_name.", at ".$formattedDate;
    DB::table('master_log')->insert([
    'log_desc' => $logg,
    'user_id' => auth()->user()->id
]);
        $response = ["message" => 'User(s) Has Been Assigned to the Role.'];
        return json_encode($response);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
