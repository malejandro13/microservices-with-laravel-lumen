<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponse;
use App\Repositories\Contracts\UserInterface;

class UserController extends Controller
{
    use ApiResponse; 

    protected $user;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Return users list
     * @return Illuminate\Http\Response
     */
    public function index() 
    {
        $users = $this->user->index();
        return $this->validResponse($users);
    }

    /**
     * Create an instance of User
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $users = $this->user->store($request);
        return $this->validResponse($users, Response::HTTP_CREATED);
    }

    /**
     * Return an specific user
     * @return Illuminate\Http\Response
     */
    public function show($user) 
    {
        $user = $this->user->show($user);
        return $this->validResponse($user);
    }

    /**
     * Update the information of an existing user
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $user) 
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'max:255|email|unique:users,email,'.$user,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $user = $this->user->update($request, $user);

        if($user) {
            return $this->validResponse($user);
        }

        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Removes an existing user 
     * @return Illuminate\Http\Response
     */
    public function destroy($user) 
    {
        $user = $this->user->destroy($user);
        return $this->validResponse($user);

    }

    /**
     * Identifies the current user
     * @return Illuminate\Http\Response
     */
    public function me(Request $request) 
    {
        return $this->validResponse($request->user());

    }
}
