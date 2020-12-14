<?php

namespace App\Http\Controllers;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Expense::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                   $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-primary btn-sm viewExpense"><i class="far fa-eye"></i></a>'.' ';
                   $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editExpense"> <i class="fa fa-edit"></i></a>';

                   $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteExpense"> <i class="fa fa-trash-alt"></i></a>';

                    return $btn;
            })
            // ->addColumn('image', function($row){

            //       $img = '<img src="'.$row->p_image.'"';

            //     return $img;
            // })
            ->rawColumns(['action'])
            ->make(true);
       }
        return view('backend.pages.expense/expense');
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
        $expense = Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => date('F'),
            'year' => date('Y'),
            'date' => date('d'),
            'created_at' => Carbon::now(),
        ]);

        if ($expense) {
            return response()->json([
                 'success' => 'Expense Saved Successfully'
            ]);
        } else{
            return response()->json([
                'error' => 'Something wrong',
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense = Expense::where('id', $id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => date('F'),
            'year' => date('Y'),
            'date' => date('d'),
            'created_at' => Carbon::now(),
        ]);

        if ($expense) {
            return response()->json([
                 'success' => 'Expense Updated Successfully'
            ]);
        } else{
            return response()->json([
                'error' => 'Something wrong',
           ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
    }

    public function today_expense()
    {
        $today = date('d');
        $todayExpense = Expense::where('date',$today )->get();
        return response()->json($todayExpense);
    }

    public function this_month_expense()
    {
        $month = date('F');
        $this_month = Expense::where('month', $month)->get();
        return response()->json($this_month);
    }
}
