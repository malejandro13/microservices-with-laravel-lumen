<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\BookInterface;

final class BookSqlRepository implements BookInterface
{

    public function index()
    {
      return DB::table('books')->get();
    }

    public function store($request)
    {
      return DB::table('books')->create($request->all());
    }

}