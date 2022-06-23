<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Validator;

class UserExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->user()->id)->with('category')->get();
        return response()->json(['expenses' => $expenses]);
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
            'amount'                => 'required|max:50',
            'entry_date'            => 'required|date',
            'expense_category_id'   => 'required'
        ]);
 
        if ($validator->fails()) 
        {
            return response()->json(['error_message' => $validator->errors()], 422);
        }
        
        if ($validator->passes()) 
        {
            $data = Expense::create($validator->validate());
            return response()->json([ 
                'expense'           => $data, 
                'success_message'   => 'Expense added successfully'
            ], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount'                => 'required|max:50',
            'entry_date'            => 'required|date',
            'expense_category_id'   => 'required'
        ]);
 
        if ($validator->fails()) 
        {
            return response()->json(['error_message' => $validator->errors()], 422);
        }
        
        if ($validator->passes()) 
        {
            $data = Expense::where('id', $id)->first();
            $data->update($validator->validate());
            return response()->json([ 
                'expense'           => $data, 
                'success_message'   => 'Expense updated successfully'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Expense::where('id', $id)->first();
        $data->delete();
        return response()->json(['msg' => 'Deleted successfully'], 200);
    }
}
