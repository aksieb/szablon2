<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function find($id) {
        return $this->model
            ->with(array(
                'productAttributes', 'files'
            ))
            ->find($id);
    }

    public function findByIds($ids) {
        return $this->model
            ->with(array(
                'productAttributes', 'files'
            ))
            ->whereIn('id', $ids)
            ->get();
    }

    public function getAllPaginated($includeCategory = false, $id = null) {
        $query = $this->model;

        if($includeCategory) {
            $query = $query->where('category_id', $id);
        }

        return $query->paginate();
    }
}
