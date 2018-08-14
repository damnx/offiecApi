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
            'inputs.*.start' => 'required|max:10',
            'inputs.*.end' => 'required|max:10',
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

        $inputs = $request->inputs;
        $check = true;
        $data = [];
        foreach ($inputs as $row) {
            $items = new Calendars([
                'day' => $row['day'],
                'date' => $row['date'],
                'start' => $row['start'],
                'end' => $row['end'],
            ]);
            if ($items->save() == false) {
                $check = false;
            } else {
                $items->groupUser()->attach($request->group_users);
                $data[] = $items;
            }
        }

        if ($check) {
            $dataNews = [
                'status' => 0,
                'error' => [],
                'data' => $data,
            ];
            return response()->json($dataNews);
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
