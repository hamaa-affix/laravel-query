<?php

namespace App\Services;

use App\Events\ContactRequestCompleted;
use App\Models\User;
use App\Models\Company;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /* repository */
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct
    (
        UserRepositoryInterface $UserRepositoryInterface
    )
    {
        $this->userRepositoryInterface = $UserRepositoryInterface;
    }
    /**
	 * user登録を行い、メール送信を行います。
     * userが会員登録を行い、メールを受信する
     * @param array $userParams
     * @param int $companyId
	 *@return void
	 */
	public function registerUser(array $userParams, int $companyId): User
    {
        $user = [
            'first_name' => $userParams['firstName'],
            'last_name' => $userParams['lastName'],
            'company_id' => $companyId,
            'email' => $userParams['email'],
            'password' => Hash::make($userParams['password']),
        ];

        $createdUser = $this->userRepositoryInterface->registerUser($user);

        event(new ContactRequestCompleted($createdUser));

        return $createdUser;
    }

    /**
	 *userが企業登録を行う
	 *@param int $companyId
	 *@param array $companyParams
	 *@return Company
	 */
	public function registerCompany(int $companyId = null, array $companyParams): Company
    {
        $company = $company = [
            'name' => $companyParams
        ];

        Log::debug("会社登録開始", ['compant_data' => $companyParams]);
        $company = Company::find($companyId);

        if(empty($company)) return Company::create($company);

        return $company;
    }
}
