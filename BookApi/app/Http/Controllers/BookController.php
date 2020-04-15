<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponse;
use App\Repositories\Contracts\BookInterface;

class BookController extends Controller
{
    use ApiResponse; 

    protected $book;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookInterface $book)
    {
        $this->book = $book;
    }

    /**
     * Return books list
     * @return Illuminate\Http\Response
     */
    public function index() 
    {
        $books = $this->book->index();
        return $this->successResponse($books);
    }

    /**
     * Create an instance of Book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request, $rules);

        $books = $this->book->store($request);
        return $this->successResponse($books, Response::HTTP_CREATED);
    }

    /**
     * Return an specific book
     * @return Illuminate\Http\Response
     */
    public function show($book) 
    {
        $book = $this->book->show($book);
        return $this->successResponse($book);
    }

    /**
     * Update the information of an existing book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book) 
    {
        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
            'price' => 'min:1',
            'author_id' => 'min:1',
        ];

        $this->validate($request, $rules);

        $book = $this->book->update($request, $book);

        if($book) {
            return $this->successResponse($book);
        }

        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Removes an existing book 
     * @return Illuminate\Http\Response
     */
    public function destroy($book) 
    {
        $book = $this->book->destroy($book);
        return $this->successResponse($book);

    }
}
