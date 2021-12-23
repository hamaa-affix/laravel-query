<?php

namespace App\Repositories\Interfaces;
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

	/**
	 * 特定のuserを取得します。
	 * @param int $userId
	 * @return User
	 */
	public function fetchUser(int $userId): User;

	/**
	 * ユーザー情報を更新します
	 * @param array $userData
	 * @return void
	 */
	public function updataUser(array $userData): void;
}
