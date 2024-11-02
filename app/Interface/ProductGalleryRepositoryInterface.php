<?php

namespace App\Interface;

interface ProductGalleryRepositoryInterface
{
    public function all($product);

    public function create(array $data);

    public function delete($id);

    public function find($id);
}
