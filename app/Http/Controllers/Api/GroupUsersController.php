<?php

namespace App\Http\Controllers\Api;

use App\GroupUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupUsersRequests;
use Illuminate\Http\Request;

// use Validator;

class GroupUsersController extends Controller
{
    protected $groupUsers;

    public function __construct(GroupUsers $groupUsers)
    {
        $this->groupUsers = $groupUsers;
    }
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
    public function store(GroupUsersRequests $request)
    {
        if ($request->isMethod('post')) {
            $data = $this->groupUsers->createGroupUsers($request);
            if ($data) {
                return response()->json([
                    'message' => 'Create success',
                    'status' => 0,
                    'error' => [],
                    'data' => $data,
                ]);
            }

            return response()->json([
                'message' => 'Create error',
                'status' => 1,
                'error' => [],
                'data' => [],
            ]);
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
        $whereData = [];
        $name = trim($request->input('name'));
        $status = trim($request->input('status'));

        if ($name) {
            $whereData[] = ['name', 'like', $name . '%'];
        }

        if ($status) {
            $whereData[] = ['status', $status];
        }

        $data = $this->groupUsers->listGroupUsers($whereData);
        if (!$data) {
            abort(404);
        }
        return response()->json([
            'message' => 'Success',
            'status' => 0,
            'error' => [],
            'data' => $data,
        ]);

    }

    public function show($id)
    {
        //
        $detailsGroupUsers = $this->groupUsers->detailsGroupUsers($id);
        if (!$detailsGroupUsers) {
            abort(404);
        }

        $data = [
            'status' => 0,
            'error' => [],
            'data' => $detailsGroupUsers,
        ];
        return response()->json($data);

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
    public function update(GroupUsersRequests $request, $id)
    {
        if ($request->isMethod('put')) {
            $data = $this->groupUsers->updateGroupUsers($request, $id);
            if ($data) {
                return response()->json([
                    'message' => 'Update success',
                    'status' => 0,
                    'error' => [],
                    'data' => $data,
                ]);
            }

            return response()->json([
                'message' => 'Update error',
                'status' => 1,
                'error' => [],
                'data' => [],
            ]);
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
        $data = $this->groupUsers->destroyGroupUsers($id);
        if ($data) {
            return response()->json([
                'message' => 'Delete success',
                'status' => 0,
                'error' => [],
                'data' => $id,
            ]);
        }
        return response()->json([
            'message' => 'Delete error',
            'status' => 1,
            'error' => [],
            'data' => [],
        ]);

    }

    public function restoreGroupUsers($id)
    {

    }
}
