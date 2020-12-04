<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-primary btn-sm viewEmployee"><i class="far fa-eye"></i></a>'.' ';
                           $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editEmployee"> <i class="fa fa-edit"></i></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployee"> <i class="fa fa-trash-alt"></i></a>';

                            return $btn;
                    })
                    // ->addColumn('image', function($row){

                    //       $img = '<img src="'.$row->p_image.'"';

                    //     return $img;
                    // })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.pages.employee/employee');
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
        if ( $request->file('photo')) {

            $get_img = $request->file('photo');
            $img_name = time().'.'.$get_img->getClientOriginalExtension();
            $destinaton_path = public_path('/employee_img');
            $get_img->move($destinaton_path, $img_name);

            $employee =  Employee::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'photo' => 'employee_img/'.$img_name,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            return response()->json($employee);

        }  else{

            $employee =  Employee::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                // 'photo' => 'employee_img/'.$img_name,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            return response()->json($employee);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return response( )->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->photo!=null){
            $employee = Employee::find($id);
            if($employee->photo != null){
                unlink($employee->photo);
            }
            $get_img = $request->file('photo');
            $img_name = time().'.'.$get_img->getClientOriginalExtension();
            $destinaton_path = public_path('/employee_img');
            $get_img->move($destinaton_path, $img_name);

            $employee = Employee::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'photo' => 'employee_img/'.$img_name,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);

            return response()->json($employee);
        } else{

            $employee = Employee::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                // 'photo' => 'employee_img/'.$img_name,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);

            return response()->json($employee);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if($employee->photo !=null){
            unlink($employee->photo);
        }

        $employee->delete();
        return response()->json($employee);
    }
}
