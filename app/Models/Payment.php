<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $hidden = [
        'updated_at'
    ];
    protected $fillable = [
        "uuid",
        "customer_id",
        "transaction_id",
        "payment_ref",
        "amount",
        "status",

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
