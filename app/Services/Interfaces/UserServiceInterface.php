<?php

namespace App\Services\Interfaces;

use App\Models\Family;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use packages\Domain\ValueObjects\User\UserFirstName;
use packages\Domain\ValueObjects\User\UserId ;

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

	/**
	 * userの名前を更新する
	 * @param UserFirstName $userfirstName
	 * @param UserId $userId
	 * @return void
	 */
	public function updateUserFirstName(UserFirstName $userfirstName, UserId $userId): void;

	/**
	 * userの苗字を更新する
	 * @param string $userLastName
	 * @param int $userId
	 * @return void
	 */
	public function updateUserLastName(string $userLastName, int $userId): void;

	/**
	 * userの電話番号を更新する
	 * @param string $userTel
	 * @param int $userId
	 * @return void
	 */
	public function updateUserTel(string $userTel, int $userId): void;

	/**
	 * userのemailを更新する
	 * @param string $userEmail
	 * @param int $userId
	 * @return void
	 */
	public function updateUserEmail(string $userEmail, int $userId): void;

	/**
	 * userの年齢を更新する
	 * @param int $userAge
	 * @param int $userId
	 * @return void
	 */
	public function updateUserAge(int $userAge, int $userId): void ;

	/**
	 * userの誕生日を更新する
	 * @param string $userBirthday
	 * @param int $userId
	 * @return void
	 */
	public function updateUserBirthday(string $userBirthday, int $userId): void;

	/**
	 * userの説明文を更新する
	 * @param string $userComment
	 * @param int $userId
	 * @return void
	 */
	public function updateUserComment(string $userComment, int $userId): void;
}
