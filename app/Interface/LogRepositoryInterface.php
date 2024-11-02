<?php

namespace App\Interface;

interface LogRepositoryInterface
{
    public function all();

    public function find($id);
}
