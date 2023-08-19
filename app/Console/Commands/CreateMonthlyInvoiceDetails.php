<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceDetails;

class CreateMonthlyInvoiceDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice-details:create-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create monthly invoice details';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $invoices = Invoice::all();

        foreach ($invoices as $invoice) {
            // Assuming you have a method to generate invoice details
            $this->generateInvoiceDetails($invoice);
        }

        $this->info('Monthly invoice details created successfully.');
    }

    protected function generateInvoiceDetails(Invoice $invoice)
    {
        // generate invoice details for the given invoice
        $invoiceDetail = new InvoiceDetails([
            'item_name' => 'Sample Item',
            'price' => 10.0,
            'quantity' => 1,
            'subtotal' => 10.0,
            'note' => 'Generated automatically',
        ]);

        $invoice->invoicesDetails()->save($invoiceDetail);
    }
}
