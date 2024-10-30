<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'cashier_id',
        'subtotal',
        'pay',
        'return',
        'pax',
        'status'
    ];

    public function cashiers()
    {
        return $this->belongsTo(User::class, 'cashier_id','id');
    }

    public function details(){
        return $this->hasMany(TransactionDetail::class);
    }
}
