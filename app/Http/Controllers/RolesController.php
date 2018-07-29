<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'required',
            'id_users' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $data = [
                'status' => 1,
                'error' => $errors,
                'data' => [],
            ];
            return response()->json($data); 
        }

        $roles = new roles;
        $roles->name = $request->name;
        $roles->id_users = $request->id_users;
        $roles->permission = $request->permission;
        $roles->description = $request->description;
        $data =$roles->save();
        
        if ($data){
            $data = [
                'status' => 0,
                'error' => [],
                'data' =>$roles,
            ];
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
