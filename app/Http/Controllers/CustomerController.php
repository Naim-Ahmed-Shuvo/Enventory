<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-primary btn-sm viewCus"><i class="far fa-eye"></i></a>'.' ';
                           $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editCus"> <i class="fa fa-edit"></i></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCus"> <i class="fa fa-trash-alt"></i></a>';

                            return $btn;
                    })
                    // ->addColumn('image', function($row){

                    //       $img = '<img src="'.$row->p_image.'"';

                    //     return $img;
                    // })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.pages.customer/customer');
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
            $destinaton_path = public_path('/customer_img');
            $get_img->move($destinaton_path, $img_name);

            $customer =  Customer::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shop_name' => $request->shop_name,
                'photo' => 'customer_img/'.$img_name,
                'account_holder' => $request->acc_holder,
                'account_number' => $request->acc_number,
                'bank_name' => $request->bank_name,
                'bank_brunch' => $request->bank_brunch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            return response()->json($customer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($request->photo != null){
            $customer = Customer::find($id);
            if($customer->photo!= null){
                unlink($customer->photo);
            }

            $img = $request->file('photo');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $destination_path = public_path('customer_img');
            $img->move($destination_path, $img_name);

            $customer = Customer::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shop_name' => $request->shop_name,
                'photo' => 'customer_img/'.$img_name,
                'account_holder' => $request->acc_holder,
                'account_number' => $request->acc_number,
                'bank_name' => $request->bank_name,
                'bank_brunch' => $request->bank_brunch,
                'city' => $request->city,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json($customer);
        }  else{
                $customer = Customer::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'shop_name' => $request->shop_name,
                    // 'photo' => 'customer_img/'.$img_name,
                    'account_holder' => $request->acc_holder,
                    'account_number' => $request->acc_number,
                    'bank_name' => $request->bank_name,
                    'bank_brunch' => $request->bank_brunch,
                    'city' => $request->city,
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json($customer);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if($customer->photo != null){
            unlink($customer->photo);
        }

        $customer->delete();
        return response()->json($customer);
    }
}
