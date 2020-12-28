<?php

namespace App\Repositories;

use App\Models\ProductAttribute;

class ProductAttributeRepository extends BaseRepository
{

    public function __construct(ProductAttribute $model)
    {
        $this->model = $model;
    }
}
