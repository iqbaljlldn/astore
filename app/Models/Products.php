<?php

namespace App\Models;

use App\Models\Suppliers;
use App\Models\Categories;
use App\Models\ProductGalleries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'category_id',
        'description',
        'barcode',
        'cost_price'
    ];

    public function categories() {
        return $this->belongsTo(Categories::class);
    }

    public function suppliers() {
        return $this->belongsToMany(Suppliers::class);
    }

    public function gallery() {
        return $this->hasMany(ProductGalleries::class);
    }
}
