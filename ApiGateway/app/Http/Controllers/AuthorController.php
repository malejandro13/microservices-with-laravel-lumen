<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorService;


class AuthorController extends Controller
{
    use ApiResponse; 

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
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return authors list
     * @return Illuminate\Http\Response
     */
    public function index() 
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create an instance of Author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return an specific author
     * @return Illuminate\Http\Response
     */
    public function show($author) 
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }

    /**
     * Update the information of an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $author) 
    {
       return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * Removes an existing author 
     * @return Illuminate\Http\Response
     */
    public function destroy($author) 
    {
       return $this->successResponse($this->authorService->deleteAuthor($author));

    }
}
