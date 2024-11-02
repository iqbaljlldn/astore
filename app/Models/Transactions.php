<?php

namespace App\Models;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'status',
        'description',
        'transaction code',
        'amount'
    ];

    public function sale() {
        return $this->belongsTo(Sales::class);
    }
}
