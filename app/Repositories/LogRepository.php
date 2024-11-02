<?php

namespace App\Repositories;

use App\Models\AuditLogs;
use App\Interface\LogRepositoryInterface;

class LogRepository implements LogRepositoryInterface
{
    public function all()
    {
        return AuditLogs::all();
    }

    public function find($id)
    {
        return AuditLogs::findOrFail($id);
    }
}
