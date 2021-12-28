<?php

namespace App\Repositories\Interfaces;
use Illuminate\Support\Collection;
use App\Models\User;
use packages\Domain\Entities\User\UserModel;
use packages\Domain\ValueObjects\User\UserId;


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
	 * @paran int $userId
	 * @return void
	 */
	public function updateUser(array $userData, int $userid): void;

	/**
	 * 特定のuserを取得します。
	 * @param UserId $userId
	 * @return object UserModel
	 */
	public function find(UserId $userId): UserModel;
}
