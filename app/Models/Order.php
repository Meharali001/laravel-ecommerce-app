<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class, 'order_id'); // Make sure 'order_id' exists in order_details table
    }
    
}

// Fetch Orders with details
