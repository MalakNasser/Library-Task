<?php

namespace App\Services;

use App\Repositories\BorrowsRepository;
use App\Repositories\CopyRepository;
use Exception;

class LibraryService
{
    protected $borrowsRepository;
    protected $copyRepository;

    public function __construct(BorrowsRepository $borrowsRepository, CopyRepository $copyRepository)
    {
        $this->borrowsRepository = $borrowsRepository;
        $this->copyRepository = $copyRepository;
    }

    public function borrowBook(array $data)
    {
        try {
            $copy = $this->copyRepository->find($data['copy_id']);
        } catch (Exception $e) {
            return response()->json(['message' => 'This copy is not found'], 400);
        }

        if ($copy->status_id == 2) {
            return response()->json(['message' => 'Book is already borrowed'], 400);
        } else if ($copy->status_id == 3 || $copy->status_id == 3) {
            return response()->json(['message' => 'Book is not available'], 400);
        }

        try {
            $this->copyRepository->update($data['copy_id'], ['status_id' => 2]);
            $this->borrowsRepository->create(array_merge($data, ['status_id' => 2]));
            return response()->json(['message' => 'Book is borrowed successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }

    public function returnBook(int $copyId, int $status_id)
    {
        try {
            $this->copyRepository->update($copyId, ['status_id' => $status_id]);
            $this->borrowsRepository->update($copyId, ['return_date' => now(), 'status_id' => $status_id]);

            return $this->copyRepository->find($copyId);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }

    public function generateReport()
    {
        try {
            $report = $this->copyRepository->allWithBooksAndStatuses();

            return response()->json($report, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }
}
