<?php
namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterFace;
use Illuminate\Support\Collection;

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
}
//EloquentActivationStaffRepository
