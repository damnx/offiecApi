<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobCalendarRequests;
use App\JobCalendar;
use Illuminate\Http\Request;

class JobCalendarController extends Controller
{
    protected $jobCalendar;

    public function __construct(JobCalendar $jobCalendar)
    {
        $this->jobCalendar = $jobCalendar;
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

    public function test(Request $request)
    {
        $data = $this->jobCalendar->createOrUpdateJobCalendar($request);
        var_dump($data);

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
    public function store(JobCalendarRequests $request)
    {
        if ($request->isMethod('post')) {
            $data = $this->jobCalendar->createJobCalendarGroupUses($request->all());
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
    public function update(JobCalendarRequests $request, $id)
    {
        $data = $this->jobCalendar->updateJobCalendars($request->all(), $id);
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
            'status' => 0,
            'error' => [],
            'data' => [],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->jobCalendar->destroyJobCalendar($id);
        if ($data) {
            return response()->json([
                'message' => 'Delete success',
                'status' => 0,
                'error' => [],
                'data' => $data,
            ]);
        }

        return response()->json([
            'message' => 'Delete error',
            'status' => 0,
            'error' => [],
            'data' => [],
        ]);

    }
}
