<?php

namespace App\Services;

use App\Interface\ProductGalleryRepositoryInterface;

class ProductGalleryService
{
    public function __construct(
        protected ProductGalleryRepositoryInterface $galleryRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->galleryRepository->create($data);
    }

    public function delete($id)
    {
        return $this->galleryRepository->delete($id);
    }

    public function all($product)
    {
        return $this->galleryRepository->all($product);
    }

    public function find($id)
    {
        return $this->galleryRepository->find($id);
    }
}
