<?php

namespace App\Models;

use App\Models\Products;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    public function product() {
        return $this->belongsTo(Products::class);
    }
    public function sale() {
        return $this->belongsTo(Sales::class);
    }
}
