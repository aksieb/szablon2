<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAllPaginated($id = null)
    {
        return $this->model
            ->where('category_id', $id)
            ->paginate();
    }

    public function getByCategoryId($id = null)
    {
        return $this->model
            ->where('category_id', $id)
            ->get();
    }
}
