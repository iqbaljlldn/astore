<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseDetailsFactory> */
    use HasFactory;

    protected $fillable = [
        'purchases_id',
        'products_id',
        'buying_price',
        'quantities',
        'subtotal'
    ];
}
