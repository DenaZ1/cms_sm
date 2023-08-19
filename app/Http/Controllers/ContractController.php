<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;

class ContractController extends Controller
{
    /**
     * Display a listing of the contracts.
     */
    public function index($customer_id)
    {
       return $this->show($customer_id);
        
    }

    /**
     * Show the form for creating a new contract.
     */
    public function create()
    {
   
    }

    /**
     * Store a newly created contract in storage.
     */
    public function store(Request $request, Customer $customer_id)
    {
        $request->validate([
            'start_date' => 'required',
            'expire_date' => 'required',
            'payment' => 'required',
            'note' => 'required',
            'created_by_user' => 'required',
        ]);
    
        $contract = new Contract([
            'start_date' => $request->input('start_date'),
            'expire_date' => $request->input('expire_date'),
            'payment' => $request->input('payment'),
            'note' => $request->input('note'),
            'created_by_user' => $request->input('created_by_user')
        ]);
    
        $customer_id->contracts()->save($contract);
    }
    

    /**
     * Display the specified contract.
     */
    public function show($identifier)
    {
 
    // The identifier is a customer_id which is fetching the contracts associated with that customer_id 
    $contracts = Contract::where('customer_id', $identifier)
    ->get();
    return $contracts;
    }    

    /**
     * Show the form for editing the specified contract.
     */
    public function edit(Contract $contract)
    {
   
    }

    /**
     * Update the specified contract in storage.
     */
    public function update(Request $request, Contract $contract, Customer $customer_id)
    {
        $request->validate([
            'start_date' => 'required',
            'expire_date' => 'required',
            'payment' => 'required',
            'note' => 'required',
            'created_by_user' => 'required'
        ]);
    
        $contract->update($request->all());
    
        return $contract;
    }

    /**
     * Remove the specified contract from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
        
        return response()->json(['message' => 'contract deleted successfully']);
    }

}
