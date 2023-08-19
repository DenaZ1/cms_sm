<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\Invoice;

class CreateMonthlyInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:create-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create monthly invoices';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {
            $invoice = new Invoice([
                'invoice_date' => now(),
                'done' => false, 
                'created_by_user' => 'Automated'
            ]);
            
            $customer->invoices()->save($invoice);
        }

        $this->info('Monthly invoices created successfully.');
    }
}

    

