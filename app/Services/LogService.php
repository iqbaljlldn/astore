<?php

namespace App\Services;

use App\Interface\LogRepositoryInterface;

class LogService
{
    public function __construct(
        protected LogRepositoryInterface $logRepository
    ) {}

    public function all()
    {
        return $this->logRepository->all();
    }

    public function find($id)
    {
        return $this->logRepository->find($id);
    }
}
