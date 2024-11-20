<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Suppliers;

class Purchases extends Model
{
    use HasFactory;

    protected $fillable = [
        'suppliers_id',
        'total_items',
        'total_price',
        'discon',
        'pay'
    ];

    public function supplier() {
        return $this->belongsTo(Suppliers::class);
    }
}
