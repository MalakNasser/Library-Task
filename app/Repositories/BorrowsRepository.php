<?php

namespace App\Repositories;

use App\Models\Borrows;
use App\Repositories\EloquentRepository;

class BorrowsRepository extends EloquentRepository
{

    public function __construct(Borrows $borrows)
    {
        parent::__construct($borrows);
    }

    public function update($id, array $data)
    {
        $model = $this->model->where('copy_id', $id)->firstOrFail();
        $model->update($data);
        return $model;
    }
}
