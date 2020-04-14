<?php

namespace App\Http\Controllers;

use App\Author;
use App\Traits\ApiResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Contracts\AuthorInterface;

class AuthorController extends Controller
{
    use ApiResponse; 

    protected $author;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorInterface $author)
    {
        $this->author = $author;
    }

    /**
     * Return authors list
     * @return Illuminate\Http\Response
     */
    public function index() 
    {
        $authors = $this->author->index();
        return $this->successResponse($authors);
    }

    /**
     * Create an instance of Author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $authors = $this->author->store($request);
        return $this->successResponse($authors, Response::HTTP_CREATED);
    }

    /**
     * Return an specific author
     * @return Illuminate\Http\Response
     */
    public function show($author) 
    {
        $author = $this->author->show($author);
        return $this->successResponse($author);
    }

    /**
     * Update the information of an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $author) 
    {
        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255',
        ];

        $this->validate($request, $rules);

        $author = $this->author->update($request, $author);

        if($author) {
            return $this->successResponse($author);
        }

        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Removes an existing author 
     * @return Illuminate\Http\Response
     */
    public function destroy($author) 
    {
        $author = $this->author->destroy($author);
        return $this->successResponse($author);

    }
}
