<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suppliers extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact_info',
        'address'
    ];

    public function products() {
        return $this->belongsToMany(Products::class);
    }
}
