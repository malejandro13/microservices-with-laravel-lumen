<?php

namespace App\Repositories\Contracts;


interface UserInterface
{
  public function index();

  public function store($request);

  public function show($user);

  public function update($request, $user);

  public function destroy($user);
}