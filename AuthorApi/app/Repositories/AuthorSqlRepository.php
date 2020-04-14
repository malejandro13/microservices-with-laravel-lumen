<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\AuthorInterface;

final class AuthorSqlRepository implements AuthorInterface
{

    public function index()
    {
      return DB::table('authors')->get();
    }

    public function store($request)
    {
      return DB::table('authors')->create($request->all());
    }

}