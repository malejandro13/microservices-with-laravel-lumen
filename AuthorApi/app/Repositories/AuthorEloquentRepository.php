<?php

namespace App\Repositories;

use App\Author;
use App\Repositories\Contracts\AuthorInterface;

final class AuthorEloquentRepository implements AuthorInterface
{

    public function index()
    {
      return Author::all();
    }

    public function store($request)
    {
      return Author::create($request->all());
    }

    public function show($author)
    {
      return Author::findOrFail($author);
    }

    public function update($request, $author)
    {
      $author = self::show($author);

      $author->fill($request->all());

      if($author->isClean()) {
        return;
      }
      
      $author->save();
      return $author;
    }

    public function destroy($author)
    {
      $author = self::show($author);
      $author->delete();
      return $author;
    }
}