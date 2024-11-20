<?php

namespace App\Models;

use App\Models\Suppliers;
use App\Models\Categories;
use App\Models\ProductGalleries;
use App\Models\SaleItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_id',
        'name',
        'buying_price',
        'discount',
        'selling_price',
        'stock',
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
