<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class ProductGalleries extends Model
{
    protected $fillable = [
        'product_id',
        'url_path'
    ];

    public function product() {
        return $this->belongsTo(Products::class);
    }
}
