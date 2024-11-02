<?php

namespace App\Repositories;

use App\Models\ProductGalleries;
use App\Interface\ProductGalleryRepositoryInterface;

class ProductGalleryRepository implements ProductGalleryRepositoryInterface
{
    public function all($product)
    {
        return ProductGalleries::all();
    }

    public function create(array $data)
    {
        return ProductGalleries::create($data);
    }

    public function delete($id)
    {
        $category = ProductGalleries::findOrFail($id);
        $category->delete();
    }

    public function find($id)
    {
        return ProductGalleries::findOrFail($id);
    }
}
