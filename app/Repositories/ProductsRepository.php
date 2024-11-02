<?php

namespace App\Repositories;

use App\Models\Products;
use App\Interface\ProductsRepositoryInterface;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function all()
    {
        return Products::with('gallery')->get();
    }

    public function create(array $data)
    {
        return Products::create($data);
    }

    public function update(array $data, $id)
    {
        $category = Products::with('gallery')->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Products::with('gallery')->findOrFail($id);
        $category->delete();
    }

    public function find($id)
    {
        return Products::with('gallery')->findOrFail($id);
    }
}
