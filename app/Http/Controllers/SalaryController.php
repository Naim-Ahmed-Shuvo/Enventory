<?php

namespace App\Http\Controllers;

use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('employees')
                      ->join('salaries', 'salaries.emp_id', '=', 'employees.id')
                      ->select('salaries.*', 'employees.name as emp_name')
                      ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-primary btn-sm viewSal"><i class="far fa-eye"></i></a>'.' ';
                           $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editSal"> <i class="fa fa-edit"></i></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSal"> <i class="fa fa-trash-alt"></i></a>';

                            return $btn;
                    })
                    // ->addColumn('image', function($row){

                    //       $img = '<img src="'.$row->p_image.'"';

                    //     return $img;
                    // })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.pages.salary/salary');
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
        if(Salary::where('emp_id', $request->emp_id)->where('month', $request->month)->exists()){
            return response()->json([
                'warning' => 'salary exists',
                '200'
            ]);
        } else{
            $salary = Salary::insert([
                'emp_id' => $request->emp_id,
                'month' => $request->month,
                'adv_salary' => $request->adv_sal,
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'success' => 'Salary saved',
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        return response()->json($salary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Salary::where('id', $id)->update([
            'emp_id' => $request->emp_id,
            'month' => $request->month,
            'adv_salary' => $request->adv_sal,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return response()->json('success', 200);
    }
}
