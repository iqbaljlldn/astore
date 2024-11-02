<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditLogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'action',
        'ip_address'
    ];
}
