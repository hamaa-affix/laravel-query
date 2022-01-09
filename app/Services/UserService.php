<?php

namespace App\Services;

use App\Events\ContactRequestCompleted;
use App\Models\User;
use App\Models\Company;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use packages\Domain\ValueObjects\User\UserFirstName;
use packages\Domain\ValueObjects\User\UserId;

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
	 *@return void
	 */
	public function registerUser(array $userParams): User
    {
        //birthdayをcarbonでパースする
        if(isset($userParams['birthDay']))  $birthDay = Carbon::parse($userParams['birthDay']);
        
        $user = [
            'first_name' => $userParams['firstName'],
            'last_name'  => $userParams['lastName'],
            'birthday'   => $birthDay ?? null,
            'age'        => (int) $userParams['age'],
            'attribute'  => (int) $userParams['attribute'],
            'email'      => $userParams['email'],
            'comment'    => $userParams['comment'] ?? null,
            'password'   => Hash::make($userParams['password']),
        ];

        return $this->userRepositoryInterface->registerUser($user);
    }

    /**
	 * JWT tokeを元にuserのtokenの有効性を確かめます。
	 * @param array $credentials
	 * @return JsonResponse|string
	 */ 
	public function attemptTokenThenRedirectOrRunning(array $credentials): JsonResponse|string
    {
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        return $token;
    }

    /**
     * userのプロフィール情報返却します。
     *
     * @param integer $userId
     * @return array
     */
    public function getProfile(int $userId): array
    {
        $user = $this->userRepositoryInterface->fetchUser($userId);
        
        return  [
            'fullName' => $user->last_name. $user->first_name,
            'age' => $user->age,
            'birthday' => $user->birthday,
            'attribute' => $user->attribute,
            'email' => $user->email,
            'tel' => $user->tel,
        ];
    }

    /**
     * userの情報を更新する
     *
     * @param array $requestData
     * @param int $userId
     * @return void
     */
    public function updateProfile(array $requestData, int $userId): void
    {
        $user = [
            'first_name' => $requestData['firstName'],
            'last_name'  => $requestData['lastName'],
            'birthday'   => $requestData['birthday'],
            'age'        => (int) $requestData['age'],
            'attribute'  => (int) $requestData['attribute'],
            'email'      => $requestData['email'],
            'comment'    => $requestData['comment']
        ];

        $this->userRepositoryInterface->updateUser($user, $userId);
    }

    /**
	 * userの名前を更新する
	 * @param UserFirstName $userfirstName
     * @param 
	 * @return void
	 */
	public function updateUserFirstName(UserFirstName $userfirstName, UserId $userId): void
    {
        $user = [ 'first_name' => $userfirstName->getFirstName()];
        $this->userRepositoryInterface->updateUser($user, $userId->getId());
    }

	/**
	 * userの苗字を更新する
	 * @param string $userLastName
     * @param int $userId
	 * @return void
	 */
	public function updateUserLastName(string $userLastName, int $userId): void
    {
        $user = ['last_name' => $userLastName];
        $this->userRepositoryInterface->updateUser($user, $userId);
    }

	/**
	 * userの電話番号を更新する
	 * @param string $userTel
     * @param int $userId
	 * @return void
	 */
	public function updateUserTel(string $userTel, int $userId): void
    {
        $user = ['tel' => $userTel];
        $this->userRepositoryInterface->updateUser($user, $userId);
    }

	/**
	 * userのemailを更新する
	 * @param string $userEmail
     * @param int $userId
	 * @return void
	 */
	public function updateUserEmail(string $userEmail, int $userId): void
    {
        $user = ['emal' => $userEmail];
        $this->userRepositoryInterface->updateUser($user, $userId);
    }

	/**
	 * userの年齢を更新する
	 * @param int $userAge
     * @param int $userId
	 * @return void
	 */
	public function updateUserAge(int $userAge, int $userId): void
    {
        $user = ['age' => $userAge];
        $this->userRepositoryInterface->updateUser($user, $userId);
    }

	/**
	 * userの誕生日を更新する
	 * @param string $userBirthday
     * @param int $userId
	 * @return void
	 */
	public function updateUserBirthday(string $userBirthday, int $userId): void
    {
        $user = ['birthday' => $userBirthday];
        $this->userRepositoryInterface->updateUser($user, $userId);
    }

	/**
	 * userの説明文を更新する
	 * @param string $userComment
     * @param int $userId
	 * @return void
	 */
	public function updateUserComment(string $userComment, int $userId): void
    {
        $user = ['comment' => $userComment];
        $this->userRepositoryInterface->updateUser($user, $userId);
    }
}
