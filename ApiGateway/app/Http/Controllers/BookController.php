<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Services\BookService;
use Illuminate\Http\Response;
use App\Services\AuthorService;


class BookController extends Controller
{
    use ApiResponse; 

    /**
     * The service to consume the book service
     * @var BookService
     */
    protected $bookService;

    /**
     * The service to consume the author service
     * @var AuthorService
     */
    protected $authorService;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return books list
     * @return Illuminate\Http\Response
     */
    public function index() 
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create an instance of Book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorService->obtainAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return an specific book
     * @return Illuminate\Http\Response
     */
    public function show($book) 
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }

    /**
     * Update the information of an existing book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book) 
    {
       return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }

    /**
     * Removes an existing book 
     * @return Illuminate\Http\Response
     */
    public function destroy($book) 
    {
       return $this->successResponse($this->bookService->deleteBook($book));

    }
}
