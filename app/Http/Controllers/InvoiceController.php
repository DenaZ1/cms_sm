<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the Invoice.
     */
    public function index($customer_id)
    {
        return $this->show($customer_id);
    }

    /**
     * Show the form for creating a new Invoice.
     */
    public function create()
    {

    }

    /**
     * Store a newly created Invoice in storage.
     */
    public function store(Request $request, Customer $customer_id)
    {
        $request->validate([
            'invoice_date' => 'required',
            'done' => 'required',
            'note' => 'required',
            'created_by_user' => 'required',
        ]);
    
        $invoice = new Invoice([
            'invoice_date' => $request->input('invoice_date'),
            'done' => $request->input('done'),
            'note' => $request->input('note'),
            'created_by_user' => $request->input('created_by_user')
        ]);

        $customer_id->contracts()->save($invoice);
    }
    /**
     * Display the specified Invoice.
     */
    public function show($identifier)
    {
    // The identifier is a customer_id which is fetching the invoices associated with that customer_id 
    $invoices = Invoice::where('customer_name', $identifier)
    ->get();
    return $invoices;

    }
    /**
     * Show the form for editing the specified Invoice.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified Invoice in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'invoice_date' => 'required',
            'done' => 'required',
            'created_by_user' => 'required'
        ]);

        $invoice->update($request->all());
        return $invoice;
        
    }

    /**
     * Remove the specified Invoice from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        
        return response()->json(['message' => 'Invoice deleted successfully']);
    }
    
}
