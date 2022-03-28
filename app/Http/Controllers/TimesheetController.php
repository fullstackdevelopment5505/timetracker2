<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\Activity;
use Illuminate\Http\Request;
use Auth;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with([
            'activities' => Activity::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => ['required', 'exists:App\Models\Activity,id', 'integer']
        ]);

        $timesheet = new Timesheet;

        $timesheet->user_id = Auth::user()->id;
        $timesheet->activity_id = $request->activity_id;
        $timesheet->started_at = date("Y-m-d H:i:s");
        $timesheet->finished_at = date("Y-m-d H:i:s");

        if ($timesheet->save()) {
            return response($timesheet->id);
        } else {
            return response("database insert failed", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        // $timesheet->touch();

        $timesheet->finished_at = date("Y-m-d H:i:s");

        if ($timesheet->save()) {
            return response("success");
        } else {
            return response("database insert failed", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
        //
    }
}
