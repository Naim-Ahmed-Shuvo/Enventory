<?php

namespace App\Http\Controllers;

use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-primary btn-sm viewSup"><i class="far fa-eye"></i></a>'.' ';
                           $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editSup"> <i class="fa fa-edit"></i></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSup"> <i class="fa fa-trash-alt"></i></a>';

                            return $btn;
                    })
                    // ->addColumn('image', function($row){

                    //       $img = '<img src="'.$row->p_image.'"';

                    //     return $img;
                    // })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.pages.suppliers/suppliers');
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
        if($request->photo != null){
            $img = $request->file('photo');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $destination_path = public_path('sup_img');
            $img->move($destination_path,$img_name);
            $supplier =   Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => $request->type,
                'photo' => 'sup_img/'.$img_name,
                'shop' => $request->shop,
                'acc_holder' => $request->acc_holder,
                'acc_number' => $request->acc_number,
                'bank_name' => $request->bank_name,
                'brunch_name' => $request->branch_name,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);

            return response()->json($supplier);
        } else{
            $supplier =   Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => $request->type,
                // 'photo' => 'sup_img/'.$img_name,
                'shop' => $request->shop,
                'acc_holder' => $request->acc_holder,
                'acc_number' => $request->acc_number,
                'bank_name' => $request->bank_name,
                'brunch_name' => $request->branch_name,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);

            return response()->json($supplier);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->photo!=null){
            $supplier = Supplier::find($id);
            if($supplier->photo != null){
                unlink($supplier->photo);
            }
            $img = $request->file('photo');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $destinaton_path = public_path('sup_img');
            $img->move($destinaton_path, $img_name);

            $supplier = Supplier::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => $request->type,
                'photo' => 'sup_img/'.$img_name,
                'shop' => $request->shop,
                'acc_holder' => $request->acc_holder,
                'acc_number' => $request->acc_number,
                'bank_name' => $request->bank_name,
                'brunch_name' => $request->branch_name,
                'city' => $request->city,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json($supplier);
        } else{

            $supplier = Supplier::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => $request->type,
                'shop' => $request->shop,
                'acc_holder' => $request->acc_holder,
                'acc_number' => $request->acc_number,
                'bank_name' => $request->bank_name,
                'brunch_name' => $request->branch_name,
                'city' => $request->city,
                'updated_at' => Carbon::now(),
            ]);

            return response()->json($supplier);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
       if($supplier->photo != null){
           unlink($supplier->photo);
       }

       $supplier->delete();
       return response()->json($supplier);
    }
}
