<?php

namespace App\Repositories;

use App\Models\Attribute;

class AttributeRepository extends BaseRepository
{

    public function __construct(Attribute $model)
    {
        $this->model = $model;
    }
}
