<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\InvoiceController;
use App\Models\Customer;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//the route for the customers
Route::resource('customers', CustomerController::class);

//the route for the contracts
Route::resource('contracts', ContractController::class);
// Routes for the ContractController
Route::post('/contracts/{customer_id}', [ContractController::class, 'store']); 

Route::get('/contracts/{customer_id}/{id}', [ContractController::class, 'show']);

Route::put('/contracts/{customer_id}/{id}', [ContractController::class, 'update']);

// A route to delete the customer with its associated data
Route::delete('customers/{customerId}/delete', 'CustomerController@deleteWithAssociatedData')->name('customers.delete');


