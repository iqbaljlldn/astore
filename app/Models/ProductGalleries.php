<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Products;

class ProductGalleries extends Model
{
    use HasFactory;
    protected $fillable = [
        'products_id',
        'url_path'
    ];

    public function product() {
        return $this->belongsTo(Products::class);
    }
}
