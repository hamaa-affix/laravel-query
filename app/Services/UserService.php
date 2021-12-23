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
            'birthday'  => $birthDay ?? null,
            'age'        => (int) $userParams['age'],
            'attribute'  => (int) $userParams['attribute'],
            'family_id'  => $userParams['family_id'] ?? null,
            'email'      => $userParams['email'],
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

    
    public function getProfile(): array
    {
        $user = $this->UserRepositoryInterface->fetchUser();
        
        return  [
            'fullName' => $user->last_name. $user->first_name,
            'age' => $user->age,
            'birthday' => $user->birthday,
            'attribute' => $user->attribute,
            'email' => $user->email,
            'tel' => $user->tel,
            'familyId' => $user->family_id 
        ];
    }

    /**
     * userの情報を更新する
     *
     * @param array $requestData
     * @return void
     */
    public function updateProfile(array $requestData): void
    {
        $user = [
            'first_name' => $requestData['firstName'],
            'last_name'  => $requestData['lastName'],
            'birthday'  => $requestData['birthday'],
            'age'        => (int) $requestData['age'],
            'attribute'  => (int) $requestData['attribute'],
            'email'      => $requestData['email'],
        ];

        $this->userRepositoryInterface->updataUser($user);
    }
}
