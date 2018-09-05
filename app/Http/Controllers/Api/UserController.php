<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersMeRequests;
use App\Http\Requests\UsersRequests;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
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
    public function me(UsersMeRequests $request)
    {

    }
    public function store(UsersRequests $request)
    {

        $data = $this->users->registerUsers($request);
        if ($data) {
            return response()->json([
                'message' => 'Register success',
                'status' => 0,
                'error' => [],
                'data' => $data,
            ]);
        }

        return response()->json([
            'message' => 'Register error',
            'status' => 1,
            'error' => [],
            'data' => [],
        ]);

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

    public function test(UsersRequests $request)
    {
        //
      dd('1232');
    }

    // không xóa khi chưa làm xong
    // public function test(){

    //     $callback = function($query) {
    //         $query->where('status', 'public');
    //     };

    //     $test = User::whereHas('groupUser',$callback)->with('groupUser','groupUser.jobCalendar')->get();
    //     return response()->json($test);
    //  }
}
