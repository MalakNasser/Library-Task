<?php

namespace App\Repositories;

use App\Models\Copy;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class CopyRepository extends EloquentRepository
{

    public function __construct(Copy $copy)
    {
        parent::__construct($copy);
    }

    public function allWithBooksAndStatuses()
    {
        return DB::table('copies')
            ->select('books.name as Book', 'copies.id as Copy ID', 'statuses.name as Status')
            ->join('books', 'copies.book_id', '=', 'books.id')
            ->join('statuses', 'copies.status_id', '=', 'statuses.id')
            ->get();
    }
}
