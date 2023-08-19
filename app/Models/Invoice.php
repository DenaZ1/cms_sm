<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_date',
        'done',
        'created_by_user'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoicesDetails()
    {
        return $this->hasMany(InvoiceDetails::class);
    }
}
