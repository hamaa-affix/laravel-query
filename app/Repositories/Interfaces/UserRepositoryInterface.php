<?php

namespace App\Repositories;
use Illuminate\Support\Collection;
use App\Models\User;


interface UserRepositoryInterface
{
	/**
	 * userを全件取得します。
	 * @return Collection
	 */
	public function getAllUser(): Collection;

	/**
	 * user登録を行います
	 * @param array $userParams
	 *@return User
	 */
	public function registerUser(array $userParams): User;
}
