<?php

namespace App\Services\Interfaces;

use App\Models\Company;
use App\Models\User;

interface UserServiceInterface {

	/**
	 * user登録を行いメール送信をします。
	 * @param array $userParams
	 * @param int $companyId
	 *@return User
	 */
	public function registerUser(array $userParams, int $companyId): User;

	/**
	 *userが企業登録を行う
	 *@param int $companyId
	 *@param array $companyParams
	 *@return Company
	 */
	public function registerCompany(int $companyId = null, array $companyParams): Company;
}
