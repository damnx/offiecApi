<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskCreateOrUpdateRequests;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

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
    public function store(TaskCreateOrUpdateRequests $request)
    {
        $idUser = Auth::id();
        $start = Carbon::parse($request->input('time_start'));
        $end = Carbon::parse($request->input('time_end'));
        $finish = $end->diffInMinutes($start);
        $false = (int) $request->input('time_comitted') - $finish;
        $description = $request->input('description');
        $dataCreate = [
            'id' => uniqid(null, true),
            'creator_id' => $idUser,
            'user_id' => $idUser,
            'name' => $request->input('name'),
            'link' => $request->input('link'),
            'status' => $request->input('status'),
            'time_comitted' => (int)$request->input('time_comitted'),
            'time_start' => $request->input('time_start'),
            'time_end' => $request->input('time_end'),
            'finish' => (int)$finish,
            'false' => $false,
            'description' => $description,
        ];
        $data = $this->task->createTask($dataCreate);
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
