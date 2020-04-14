<?php

namespace App\Repositories\Contracts;


interface AuthorInterface
{
  public function index();

  public function store($request);

  public function show($author);

  public function update($request, $author);

  public function destroy($author);
}