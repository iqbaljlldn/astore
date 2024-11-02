<?php

namespace App\Services;

use App\Interface\SalesRepositoryInterface;

class SalesService
{
    public function __construct(
        protected SalesRepositoryInterface $saleRepository
    ) {
    }

    public function with($relations) {
        $this->saleRepository->with($relations);
        return $this;
    }

    public function create(array $data)
    {
        return $this->saleRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->saleRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->saleRepository->delete($id);
    }

    public function all()
    {
        return $this->saleRepository->all();
    }

    public function find($id)
    {
        return $this->saleRepository->find($id);
    }
}
