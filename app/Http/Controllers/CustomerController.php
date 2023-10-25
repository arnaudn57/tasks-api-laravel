<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::where('user_id', auth()->user()->id)->get();

        return response([
            'customers' => $customers
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|string',
            'customer_phone' => 'string',
            'customer_address' => 'string',
            'customer_city' => 'string',
            'customer_state' => 'string',
            'customer_zip' => 'string',
            'customer_country' => 'string',
            'customer_status' => 'string',
            'customer_notes' => 'string',
        ]);

        $customer = Customer::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'customer_city' => $request->customer_city,
            'customer_state' => $request->customer_state,
            'customer_zip' => $request->customer_zip,
            'customer_country' => $request->customer_country,
            'customer_status' => $request->customer_status,
            'customer_notes' => $request->customer_notes,
            'user_id' => auth()->user()->id,
        ]);

        return response([
            'message' => 'Customer created successfully',
            'customer' => $customer
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $customer_id)
    {
        $customer = Customer::where('id', $customer_id)->where('user_id', auth()->user()->id)->first();

        return response([
            'customer' => $customer
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $customer_id)
    {

        $customer = Customer::where('id', $customer_id)->where('user_id', auth()->user()->id)->first();
        $customer->update($request->all());

        return response([
            'message' => 'Customer updated successfully',
            'customer' => $customer
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($customer_id)
    {
        $customer = Customer::where('id', $customer_id)->where('user_id', auth()->user()->id)->first();
        $customer->delete();

        return response([
            'message' => 'Customer deleted successfully'
        ], 200);
    }
}
