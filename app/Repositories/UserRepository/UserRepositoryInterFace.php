<?php

namespace App\Repositories\UserRepository;
use Illuminate\Support\Collection;


interface UserRepositoryInterFace
{
  /**
   * userを全件取得します。
   * @return Collection
   */
  public function getAllUser(): Collection;
}
