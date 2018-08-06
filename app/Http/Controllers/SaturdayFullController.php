<?php

namespace App\Http\Controllers;

use App\SaturdayFulls;
use Illuminate\Http\Request;
use Validator;

class SaturdayFullController extends Controller
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
            'inputs'=>'required|array',
            'inputs.*.id_group_users' => 'required|numeric',
            'inputs.*.date_saturday_fulls' => 'required|json',
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
            $items = new SaturdayFulls([
                'id_group_users' => $row['id_group_users'],
                'date_saturday_fulls' => $row['date_saturday_fulls'],
            ]);
            if ($items->save() == false) {
                $check = false;
            } else {
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
