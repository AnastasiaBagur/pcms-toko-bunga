<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['customer_name', 'total_price', 'payment_status'];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
