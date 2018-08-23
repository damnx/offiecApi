<?php

namespace App\Http\Controllers\Api;

use App\GroupUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class GroupUsersController extends Controller
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
            'name' => 'required|unique:group_users|max:100',
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

        try {
            $groupUsers = new groupUsers;
            $groupUsers->name = $request->name;
            $groupUsers->status = $request->status;
            $groupUsers->save();
            $data = [
                'status' => 0,
                'error' => [],
                'data' => $groupUsers,
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getListGroupUsers(Request $request)
    {
        // get list group users kèm theo điều kiện tìm kiếm và phân trang
        try {

            $whereData = [];

            $name = trim($request->input('name'));
            $status = trim($request->input('status'));

            if ($name) {
                $whereData[] = ['name', 'like', $name . '%'];
            }

            if ($status) {
                $whereData[] = ['status', $status];
            }

            $listGroupUsers = GroupUsers::with('users')
                ->where($whereData)
                ->paginate(20);
            $data = [
                'status' => 0,
                'error' => [],
                'data' => $listGroupUsers,
            ];
            return response()->json($data);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function show($id)
    {
        //
        try {
            $showDetailsGroupUsers = GroupUsers::with('users')
                ->where('id', $id)
                ->where('status', 'public')
                ->first();

            if ($showDetailsGroupUsers) {
                $data = [
                    'status' => 0,
                    'error' => [],
                    'data' => $showDetailsGroupUsers,
                ];
                return response()->json($data);

            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

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
        $findGroupUsers = GroupUsers::find($id);
        if ($findGroupUsers) {
            $name = trim($findGroupUsers->name);
            $arrayValidator = [];
            if ($name != trim($request->name)) {
                $arrayValidator['name'] = 'required|unique:group_users|max:100';
                $arrayValidator['status'] = 'required';

            } else {
                $arrayValidator['status'] = 'required';
            }

            $validator = Validator::make($request->all(), $arrayValidator);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $data = [
                    'status' => 1,
                    'error' => $errors,
                    'data' => [],
                ];
                return response()->json($data);
            }

            try {
                $updateGroupUsers = GroupUsers::where('id', $id)
                    ->update(['name' => trim($request->name), 'status' => $request->status]);
                $data = [
                    'status' => 0,
                    'error' => [],
                    'data' => ['name' => trim($request->name), 'status' => $request->status],
                ];
                return response()->json($data);

            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            $data = [
                'status' => 1,
                'error' => ['notFound' => 'cannot find update value'],
                'data' => [],
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
        try {
            $groupUsers = GroupUsers::destroy($id);
            $data = [
                'status' => 0,
                'error' => [],
                'data' => $groupUsers,
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function restoreGroupUsers($id)
    {
        try {
            $withTrashedGroupUsers = GroupUsers::withTrashed()
                ->where('id', $id)
                ->restore();
            $data = [
                'status' => 0,
                'error' => [],
                'data' =>  $withTrashedGroupUsers,
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
