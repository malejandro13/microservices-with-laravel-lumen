<?php

namespace App\Repositories;

use App\Book;
use App\Repositories\Contracts\BookInterface;

final class BookEloquentRepository implements BookInterface
{

    public function index()
    {
      return Book::all();
    }

    public function store($request)
    {
      return Book::create($request->all());
    }

    public function show($book)
    {
      return Book::findOrFail($book);
    }

    public function update($request, $book)
    {
      $book = self::show($book);

      $book->fill($request->all());

      if($book->isClean()) {
        return;
      }
      
      $book->save();
      return $book;
    }

    public function destroy($book)
    {
      $book = self::show($book);
      $book->delete();
      return $book;
    }
}