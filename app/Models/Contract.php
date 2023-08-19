<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'expire_date',
        'payment',
        'note',
        'created_by_user'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}