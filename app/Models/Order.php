<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'user_id', 'product_name', 'price', 'quantity', 'total', 'status', 'address', 'phone_number', 'email', 'note_order', 'created_at', 'updated_at'
    ];
}
