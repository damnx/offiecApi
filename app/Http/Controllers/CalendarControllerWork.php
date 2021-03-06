<?php

namespace App\Http\Controllers;

use App\Calendars;
use Illuminate\Http\Request;
use Validator;

class CalendarControllerWork extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function test()
    {

    }

    public function getCalendarWork($date)
    {
        $calendars = Calendars::with(['groupUser' => function ($query) {
            $query->where('status', '=', 'public');
            $query->with('user');
        }])->where('date', 'like', $date . '%')->get();

        $dataNews = [
            'status' => 0,
            'error' => [],
            'data' => $calendars,
        ];
        return response()->json($dataNews);
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
            'group_users' => 'required|array',
            'inputs' => 'required|array',
            'inputs.*.day' => 'required|numeric',
            'inputs.*.date' => 'required|max:20',
            'start' => 'required',
            'end' => 'required',
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

        

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
