<?php

namespace App\Services\Interfaces;

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

}
