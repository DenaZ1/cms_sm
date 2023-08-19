<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'price',
        'quantity',
        'subtotal',
        'note'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}