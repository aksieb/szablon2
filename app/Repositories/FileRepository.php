<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository extends BaseRepository
{

    public function __construct(File $model)
    {
        $this->model = $model;
    }

    public function getLogo() {
        return $this->model
            ->where('relation', 'logo')
            ->first();
    }
}
