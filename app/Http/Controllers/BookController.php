<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{

    /**
     * Return books list
     * @return Ilumnate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $this->successResponse($books);
    }

    /**
     * Create an instance of books
     * @return Ilumnate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    /**
     * Return book data
     * @return Ilumnate\Http\Response
     */
    public function show($bookId)
    {
        $book = Book::findOrFail($bookId);
        return $this->successResponse($book);
    }

    /**
     * Update the information of an existing book
     * @return Ilumnate\Http\Response
     */
    public function update(Request $request, $bookId)
    {
        $rules = [
            'title' => 'string|max:255',
            'description' => 'string|max:255',
            'price' => 'min:1',
            'author_id' => 'min:1'
        ];

        $this->validate($request, $rules);

        $book = Book::findorFail($bookId);

        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);
    }

    /**
     * Destroy an existing book
     * @return Ilumnate\Http\Response
     */
    public function destroy($bookId)
    {
        $book = Book::findOrFail($bookId);
        $book->delete();
        return $this->successResponse($book);
    }
}
