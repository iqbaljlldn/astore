<?php

namespace App\Models;

use App\Models\Products;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SaleItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_id',
        'products_id',
        'quantity',
        'price',
        'discon',
        'subtotal'
    ];

    public function product() {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
    public function sale() {
        return $this->belongsTo(Sales::class);
    }
    public function gallery() {
        return $this->HasManyThrough(ProductGalleries::class, Products::class);
    }
}
