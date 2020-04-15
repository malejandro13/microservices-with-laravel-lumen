<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Contracts\UserInterface;

final class UserEloquentRepository implements UserInterface
{

    public function index()
    {
      return User::all();
    }

    public function store($request)
    {
      return User::create($request->all());
    }

    public function show($user)
    {
      return User::findOrFail($user);
    }

    public function update($request, $user)
    {
      $user = self::show($user);

      $user->fill($request->all());

      if($user->isClean()) {
        return;
      }
      
      $user->save();
      return $user;
    }

    public function destroy($user)
    {
      $user = self::show($user);
      $user->delete();
      return $user;
    }
}