<?php

namespace App\Models;

use App\Models\SaleItems;
use App\Models\User;
use App\Models\Customers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'customers_id',
        'total_items',
        'discon',
        'total_price',
        'pay',
        'payment_method',
        'payment_status',
    ];

    public function saleItems() {
        return $this->hasMany(SaleItems::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function transactions() {
        return $this->hasMany(Transactions::class);
    }
    public function customer() {
        return $this->belongsTo(Customers::class);
    }
}
