<?php

namespace App\Repositories;

use App\Models\Customers;
use App\Interface\CustomersRepositoryInterface;

class CustomersRepository implements CustomersRepositoryInterface
{
    public function all()
    {
        return Customers::all();
    }

    public function create(array $data)
    {
        return Customers::create($data);
    }

    public function update(array $data, $id)
    {
        $category = Customers::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Customers::findOrFail($id);
        $category->delete();
    }

    public function find($id)
    {
        return Customers::findOrFail($id);
    }
}
