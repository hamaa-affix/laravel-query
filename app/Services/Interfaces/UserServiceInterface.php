<?php

namespace App\Services\Interfaces;

use App\Models\Family;
use App\Models\User;
use Illuminate\Http\JsonResponse;

interface UserServiceInterface {

	/**
	 * user登録を行いメール送信をします。
	 * @param array $userParams
	 *@return User
	 */
	public function registerUser(array $userParams): User;

	/**
	 * JWT tokeを元にuserのtokenの有効性を確かめます。
	 * @param array $credentials
	 * @return JsonResponse|string
	 */ 
	public function attemptTokenThenRedirectOrRunning(array $credentials): JsonResponse|string;

	/**
	 * userのデータをデータ形成し返却する。
	 * @param int $userId
	 * @return array
	 */
	public function getProfile(int $userId): array;

	/**
     * userの情報を更新する
     *
     * @param array $requestData
	 * @param int $userId
     * @return void
     */
    public function updateProfile(array $requestData, int $userId): void;
}
