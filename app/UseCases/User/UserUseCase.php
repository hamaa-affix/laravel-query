<?php
namespace App\UseCases\User;

use App\Repositories\UserRepository\UserRepositoryInterFace;
use App\UseCases\User\UserUseCaseInterFace;

final class UserUseCase implements UserUseCaseInterFace
{
	/**
	 * @var UserReposity
	 */
	private UserRepositoryInterFace $userRepository;

	public function __construct(UserRepositoryInterFace $userRepository )
	{
		$this->userRepository = $userRepository;
	}

	public function getUser(): array
	{
		$users = $this->userRepository->getAllUser();

		$data = [];
		foreach($users as $user) {
			$data[] = [
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
			];
		}

		return $data;
	}
}
