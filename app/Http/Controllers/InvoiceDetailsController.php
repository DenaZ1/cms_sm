<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the Invoice details.
     */
    public function index($invoice_id)
    {
        return $this->show($invoice_id);
    }

    /**
     * Show the form for creating a new Invoice detail.
     */
    public function create() 
    {

    }
    /**
     * Store a newly created Invoice detail in storage.
     */
    public function store(Request $request, Invoice $invoice_id)
    {
        $request->validate([
            'item_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'sub_total' => 'required',
        ]);
    
        $invoice_Details = new Invoice([
            'item_name' => $request->input('item_name'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'sub_total' => $request->input('sub_total')
        ]);
    
        $invoice_id->invoiceDetails()->save($invoice_Details);
    }


    /**
     * Display the specified Invoice detail.
     */
    public function show($identifier)
    {
        $contracts = Invoice::where('customer_id', $identifier)
        ->get();
        return $contracts;
    }

    /**
     * Show the form for editing the specified Invoice detail.
     */
    public function edit(InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Update the specified Invoice detail in storage.
     */
    public function update(Request $request, InvoiceDetails $invoiceDetails)
    {
        $request->validate([
            'item_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'subtotal' => 'required',
            'note' => 'required'
        ]);

        $invoiceDetails->update($request->all());

        return $invoiceDetails;
    }

    /**
     * Remove the specified Invoice detail from storage.
     */
    public function destroy(InvoiceDetails $invoiceDetails)
    {
        $invoiceDetails->delete();
        
        return response()->json(['message' => 'Invoice Details deleted successfully']);
    }
    
}