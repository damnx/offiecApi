<?php

namespace App\Http\Controllers;

use App\GroupUser;
use Illuminate\Http\Request;
use Validator;

class GroupUserController extends Controller
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

    public function getAllGroupUsers(Request $request)
    {
        $dataGroupUser = GroupUser::withCount('user')->orderBy('id', 'desc')->paginate($request->page_size);
        $data = [
            'status' => 0,
            'error' => [],
            'data' => $dataGroupUser,
        ];
        return response()->json($data);

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
            'name' => 'required|unique:group_users',
            'status' => 'required',
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

        $dataGroupUsers = [
            'name' => $request->name,
            'status' => $request->status,
        ];

        $groupUsers = GroupUser::create($dataGroupUsers);

        if ($groupUsers) {
            $data = [
                'status' => 0,
                'error' => [],
                'data' => $groupUsers,
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
        $name = $request->name;
        $nameParent = $request->nameParent;
        $dataValidator = [
            'status' => 'required',
        ];
        if ($name != $nameParent) {
            $dataValidator = [
                'name' => 'required|unique:group_users',
                'status' => 'required',
            ];
        }
        $validator = Validator::make($request->all(), $dataValidator);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $data = [
                'status' => 1,
                'error' => $errors,
                'data' => [],
            ];
            return response()->json($data);
        }

        $groupUsers = GroupUser::where('id', $id)->update(['status' => $request->status, 'name' => $request->name]);
        if ($groupUsers) {
            $data = [
                'status' => 0,
                'error' => [],
                'data' => $groupUsers,
            ];
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $groupUsers = GroupUser::destroy($id);
        if ($groupUsers) {
            $data = [
                'status' => 0,
                'error' => [],
                'data' => [],
            ];
            return response()->json($data);
        }

        $data = [
            'status' => 1,
            'error' => [],
            'data' => [],
        ];
        return response()->json($data);

    }
}
