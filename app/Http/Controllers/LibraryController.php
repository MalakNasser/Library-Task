<?php

namespace App\Http\Controllers;

use App\Services\LibraryService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Library",
 *     description="API Endpoints for Users"
 * )
 */
class LibraryController extends Controller
{
    protected $libraryService;

    public function __construct(LibraryService $libraryService)
    {
        $this->libraryService = $libraryService;
    }

    /**
     * @OA\Post(
     *     path="/api/library/book/borrow",
     *     tags={"Library"},
     *     summary="Borrow Book (POST)",
     *     description="Add new borrowed copies",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="student_id", type="integer"),
     *             @OA\Property(property="copy_id", type="integer"),
     *             @OA\Property(property="expected_return_date", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book is borrowed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Book is borrowed successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Something went wrong")
     *         )
     *     )
     * )
     */
    public function borrowBook(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|integer',
            'copy_id' => 'required|integer',
            'expected_return_date' => 'required|date',
        ]);

        return $this->libraryService->borrowBook($data);
    }


    /**
     * @OA\Put(
     *     path="/api/library/book/return/{id}",
     *     tags={"Library"},
     *     summary="Return Book (PUT)",
     *     description="Update borrowed copies",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Copy ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="status_id", type="integer"),
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="A new borrowed copy",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="book_id", type="integer"),
     *                     @OA\Property(property="status_id", type="integer"),
     *                 )
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Something went wrong")
     *         )
     *     )
     * )
     */
    public function returnBook(Request $request, $id)
    {

        $data = $request->validate([
            'status_id' => 'required|integer',
        ]);

        return $this->libraryService->returnBook($id, $data["status_id"]);
    }

    /**
     * @OA\Get(
     *     path="/api/library/report",
     *     tags={"Library"},
     *     summary="Generate Report (get)",
     *     description="Get all borrowed copies with their books and statuses",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="All borrowed copies with their books and statuses",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="Book", type="string", example="Clean Code"),
     *                    @OA\Property(property="Copy ID", type="integer", example="1"),
     *                    @OA\Property(property="Status", type="string", example="Borrowed"),
     *                 )
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Something went wrong")
     *         )
     *     )
     * )
     */
    public function generateReport()
    {
        return $this->libraryService->generateReport();
    }
}
