<?php

namespace App\Repositories;

use App\Models\Categories;
use App\Interface\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Categories::all();
    }

    public function create(array $data)
    {
        return Categories::create($data);
    }

    public function update(array $data, $id)
    {
        $category = Categories::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
    }

    public function find($id)
    {
        return Categories::findOrFail($id);
    }
}
