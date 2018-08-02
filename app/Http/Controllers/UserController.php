<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $data = [
            'status' => 0,
            'error' => [],
            'data' => $user,
        ];
        return response()->json($data);
    }

    public function me(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
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

        $email = $request->username;
        $flightUser = User::where('email', $email)->first();
        $flightUser->roles;
        $roles = $flightUser['roles'];
        $permission = '';
        foreach ($roles as $key => $value) {
            $permission = ($permission != '') ? $permission . ',' . $value['permission'] : $value['permission'];
        }
        $permission = ($permission != '') ? array_combine(explode(",", $permission), explode(",", $permission)) : [];
        unset($flightUser['roles']);
        $flightUser['permission'] = $permission;
        $data = [
            'status' => 0,
            'error' => [],
            'data' => $flightUser,
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'full_name' => 'required',
            'address' => 'required',
            'gender' => 'required|numeric',
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

        $user = new user;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->full_name;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->is_active = $request->is_active;
        $user->phone_number = $request->phone_number;
        $user->is_online = 0;
        $user->level = 1;
        $user->is_sadmin = 0;
        $data = $user->save();

        if ($data) {
            $data = [
                'status' => 0,
                'error' => [],
                'data' => $user,
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
