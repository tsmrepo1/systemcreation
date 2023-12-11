<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rolls = DB::select('SELECT id,role_name FROM roles');
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
                    $response = ["message" => 'A New Role Has Been Created Successfully.'];
                    return json_encode($response);
                }else{
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
        $resultn = DB::select('SELECT * FROM roles WHERE id = ?', [$id]);
        $X = $resultn[0]->user_ids;
        $csvString = implode(',', $request->users);
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
