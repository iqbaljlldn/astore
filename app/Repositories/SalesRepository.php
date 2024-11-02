<?php

namespace App\Repositories;

use App\Models\Sales;
use App\Interface\SalesRepositoryInterface;

class SalesRepository implements SalesRepositoryInterface
{
    protected $with = [];

    public function with($relations) {
        $this->with = is_array($relations) ? $relations : func_get_args();
        return $this;
    }
    public function all()
    {
        $result = Sales::with($this->with)->get();
        $this->with = []; // Reset $with
        return $result;
    }

    public function create(array $data)
    {
        return Sales::create($data);
    }

    public function update(array $data, $id)
    {
        $category = Sales::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Sales::findOrFail($id);
        $category->delete();
    }

    public function find($id)
    {
        $result = Sales::with($this->with)->findOrFail($id);
        $this->with = []; // Reset $with
        return $result;
    }
}
