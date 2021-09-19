<?php
namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterFace;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterFace
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
}
