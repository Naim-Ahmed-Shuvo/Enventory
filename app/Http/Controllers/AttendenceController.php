<?php

namespace App\Http\Controllers;

use App\Attendence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.attendence/attendence');
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

    public function take_attendence(Request $request)
    {
        if(Attendence::where('date', date('d'))->exists()){
            return back()->with('warning', 'Attendence Already Taken');
        }else{
            foreach ($request->employee_id as $emp_id) {
                $data[] = [
                    'user_id' => $emp_id,
                    'attendence' => $request->attendence[$emp_id],
                    'date' => date('d'),
                    'year' => date('Y'),
                    'edit_date' => date('d_m_y'),
                    'created_at' => Carbon::now(),
                ];
            }

            $attendence = Attendence::insert($data);

            return back()->with('success', 'Attendence Taken');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function show(Attendence $attendence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendence $attendence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendence $attendence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendence $attendence)
    {
        //
    }
}
