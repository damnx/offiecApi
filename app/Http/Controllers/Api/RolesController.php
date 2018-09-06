<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Roles;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRolesRequests;

class RolesController extends Controller
{
    protected $roles;

    public function __construct(Roles $roles)
    {
        $this->roles = $roles;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRolesRequests $request)
    {
        if ($request->isMethod('post')) {
            $data = $this->roles->createRoles($request);
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
    public function show($id)
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
