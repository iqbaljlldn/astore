<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditures extends Model
{
    /** @use HasFactory<\Database\Factories\ExpendituresFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'nominal'
    ];
}
