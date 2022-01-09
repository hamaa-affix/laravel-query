<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;
use packages\Domain\Entities\User\UserModel;
use packages\Domain\ValueObjects\User\UserId;

class EloquentUserRepository implements UserRepositoryInterface
{
	/**
	 * @param User
	 */
	private User $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * 全てのUserを取得し返却します
	 * @return Collection
	 */
    public function getAllUser(): Collection
	{
		return $this->user->all();
	}

	/**
	 * user登録を行います
	 * @param array $userParams
	 *@return User
	 */
	public function registerUser(array $userParams): User
	{
		return User::create($userParams);
	}

	/**
	 * 特定のuserを取得します。
	 * @param int $userId
	 * @return User
	 */
	public function fetchUser(int $userId): User
	{
		return User::find($userId);
	}

	/**
	 * ユーザー情報を更新します
	 * @param array $userData
	 * @param int $userId
	 * @param void
	 */
	public function updateUser(array $userData, int $userId): void
	{
		User::where('id', $userId)->update($userData);
	}

	/**
	 * 特定のuserを取得します。
	 * @param int $userId
	 * @return object UserModel
	 */
	public function find(UserId $userId): UserModel
	{
		$user = $this->user->find($userId);

		$userModel = new UserModel();
		return $userModel->reconstruct(
			$user->id,
			$user->first_name,
			$user->last_name,
			$user->age,
			$user->tel,
			$user->email,
			$user->password,
			$user->attribute,
			$user->comment
		);
	}
}

