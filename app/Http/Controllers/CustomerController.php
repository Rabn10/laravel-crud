<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $customers = $customers->map(function ($c){
            return collect($c)->merge(['createdBy' => $c->createdBy()->first(['id', 'name'])])->except(['updatedBy', 'delete_flag','created_at','updated_at']);
        });
        return  response()-> json([
            "data"=>$customers
            ],200);

//        $customer = Customer::where('delete_flag',false)->get()->except(['updatedBy']);
//        return  $customer = $customer->paginate(5);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->contactNo = $request->contactNo;
        $customer->time = $request->time;
        $customer->reservedDate = $request->reservedDate;
        $customer->createdBy = Auth::id();
        $customer->updatedBy = Auth::id();
        $customer->save();
        return response()->json([
            "message"=> "Successfully booked"
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete_flag = true;
        $customer->save();
        return  response()->json([
            "message"=>"Customer removed successfully!"
        ],200);
    }
}
