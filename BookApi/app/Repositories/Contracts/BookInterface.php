<?php

namespace App\Repositories\Contracts;


interface BookInterface
{
  public function index();

  public function store($request);

  public function show($book);

  public function update($request, $book);

  public function destroy($book);
}