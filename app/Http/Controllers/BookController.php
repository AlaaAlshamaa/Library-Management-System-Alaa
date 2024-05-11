<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Events\BookAdded;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\BookResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Cache::remember('books',120,function () {
            return Book::with('authers')->get();
        });
        return $this->customeResponse(BookResource::collection($books),'Done',200);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        try {
            DB::beginTransaction();

            $book = Book::create([
                'title' => $request->title,
                'amount' => $request->amount,
                'published_at' => $request->published_at,
                'city' => $request->city,
                'available' => $request->available,
            ]);
            DB::commit();
            return $this->customeRespone(new BookResource($book), 'Book created successfully', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, 'Failed to create book', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $data = new BookResource($book);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        try {
            DB::beginTransaction();
            $book->update([
                'title' => $request->title,
                'amount' => $request->amount,
                'published_at' => $request->published_at,
                'city' => $request->city,
                'available' => $request->available,
            ]);
            DB::commit();

            return $this->customeRespone(new BookResource($book), 'Book updated successfully', 200);

        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeRespone(null, 'Failed to update book', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

            $book->delete();
            return $this->customeRespone(null, 'Book deleted successfully', 200);


    }
}