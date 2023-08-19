<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_num' => 'required',
            'free_trial' => 'required',
            'start_date' => 'required',
            'note' => 'required',
            'created_by_user' => 'required'
        ]);
    
        return Customer::create($request->all());
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_num' => 'required',
            'free_trial' => 'required',
            'start_date' => 'required',
            'note' => 'required',
            'created_by_user' => 'required'
        ]);
    
        $customer->update($request->all());
    
        return $customer;
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        
    // Delete invoice details
    $customer->invoices()->each(function ($invoice) {
        $invoice->invoicesDetails()->delete();
    });

    // Delete invoices
    $customer->invoices()->delete();

    // Delete contracts
    $customer->contracts()->delete();
    
    // Delete customer
    $customer->delete();

    return redirect()->route('customers.index')->with('success', 'Customer and associated data deleted successfully.');
    }
}
