<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
             $data = DB::table('products')
                          ->join('categories', 'categories.id', '=', 'products.cat_id')
                          ->select('categories.*', 'products.*')
                          ->get();
             return Datatables::of($data)
             ->addIndexColumn()
             ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-primary btn-sm viewProduct"><i class="far fa-eye"></i></a>'.' ';
                    $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editProduct"> <i class="fa fa-edit"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"> <i class="fa fa-trash-alt"></i></a>';

                     return $btn;
             })
             // ->addColumn('image', function($row){

             //       $img = '<img src="'.$row->p_image.'"';

             //     return $img;
             // })
             ->rawColumns(['action'])
             ->make(true);
        }

        return view('backend.pages.product/product');
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
        if($request->p_img != null){
            $img = $request->file('p_img');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $path = public_path('product_img');
            $img->move($path, $img_name);

            $product = Product::insert([
                'cat_id' => $request->category_id,
                'p_name' => $request->prd_name,
                'sup_id' => $request->sup_id,
                'p_code' => $request->p_code,
                'p_garage' => $request->p_garage,
                'p_route' => $request->p_route,
                'p_image' => 'product_img/'.$img_name,
                'buy_date' => $request->buy_date,
                'expire_date' => $request->ex_date,
                'selling_price' => $request->selling_price,
                'buying_price' => $request->buying_price,
                'created_at' => Carbon::now(),
            ]);

            if($product){
                return response()->json([
                   'success' => 'Product Saved Successfully',
                ]);
            } else{
                return response()->json([
                    'error' => 'Something wrong',
                 ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $id = $product->id;
        $product_info = DB::table('products')
                         ->join('categories', 'categories.id', '=', 'products.cat_id')
                         ->join('suppliers','suppliers.id', '=', 'products.sup_id')
                         ->select('suppliers.name as sup_name', 'categories.cat_name', 'products.*')
                         ->where('products.id', $id)
                         ->first();
        return response()->json($product_info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->p_img  != null){
             $product_img = Product::find($id);
             if($product_img->p_image != null){
                 unlink($product_img->p_image);
             }

             $img = $request->file('p_img');
             $img_name = time().'.'.$img->getClientOriginalExtension();
             $path = public_path('product_img');
             $img->move($path, $img_name);

             $product = Product::where('id', $id)->update([
                 'cat_id' => $request->category_id,
                 'p_name' => $request->prd_name,
                 'sup_id' => $request->sup_id,
                 'p_code' => $request->p_code,
                 'p_garage' => $request->p_garage,
                 'p_route' => $request->p_route,
                 'p_image' => 'product_img/'.$img_name,
                 'buy_date' => $request->buy_date,
                 'expire_date' => $request->ex_date,
                 'selling_price' => $request->selling_price,
                 'buying_price' => $request->buying_price,
                 'updated_at' => Carbon::now(),
             ]);

             if($product){
                 return response()->json([
                    'success' => 'Product Updated Successfully',
                 ]);
             } else{
                return response()->json([
                    'error' => 'Something wrong',
                 ]);
            }
        } else{
            $product = Product::where('id', $id)->update([
                'cat_id' => $request->category_id,
                'p_name' => $request->prd_name,
                'sup_id' => $request->sup_id,
                'p_code' => $request->p_code,
                'p_garage' => $request->p_garage,
                'p_route' => $request->p_route,
                // 'p_image' => 'product_img/'.$img_name,
                'buy_date' => $request->buy_date,
                'expire_date' => $request->ex_date,
                'selling_price' => $request->selling_price,
                'buying_price' => $request->buying_price,
                'updated_at' => Carbon::now(),
            ]);

            if($product){
                return response()->json([
                   'success' => 'Product Updated Successfully',
                ]);
            } else{
               return response()->json([
                   'error' => 'Something wrong',
                ]);
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->p_image != null){
            unlink($product->p_image);
        }

        $product->delete();

    }
}
