<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\EloquentUserRepository;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use packages\Domain\ValueObjects\User\UserFirstName;
use packages\Domain\ValueObjects\User\UserId;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserService $userService;
    private EloquentUserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $user = new User();
        $this->userRepository = new EloquentUserRepository($user);
        $this->userService = new UserService($this->userRepository);
    }


    /**
     * @test
     */
    public function test_user登録ができること()
    {
        $userParams = [
            'firstName' => 'test太郎',
            'lastName'  => '山田',
            'age'        => 20,
            'attribute'  => 0,
            'email'      => 'example@example.com',
            'password'   => 'hogehoge',
        ];

        $insertData = [
            'first_name' => 'test太郎',
            'last_name'  => '山田',
            'age'        => 20,
            'attribute'  => 0,
            'email'      => 'example@example.com',
        ];

        $user = $this->userService->registerUser($userParams);
        $this->assertDatabaseHas('users', $insertData);
    }

    /**
     * プロフィールを取得できること
     * @test
     */
    public function test_userのprofile情報を返却できること()
    {
        $user = factory(User::class, 1)->create();
        $profile = $this->userService->getProfile($user[0]->id);

        $userData = [
            'fullName' => $user[0]->last_name. $user[0]->first_name,
            'age' => $user[0]->age,
            'birthday' => $user[0]->birthday,
            'attribute' => $user[0]->attribute,
            'email' => $user[0]->email,
            'tel' => $user[0]->tel,
        ];
        $this->assertEquals($userData, $profile);
        
    }

    /**
     * user情報の更新ができること
     * @test
     */
    public function test_user情報を更新できること()
    {
        $user = factory(User::class, 1)->create();
        $updateUser = [
            'firstName'  => 'mami',
            'lastName'   => 'hamada',
            'birthday'   => '1989-09-25',
            'email'      => 'example@example.com',
            'age'        => 31,
            'attribute'  => 1,
            'comment'    => "this is hogehoge"
        ];
    
        $compareUserData = [
            'first_name'  => 'mami',
            'last_name'   => 'hamada',
            'birthday'   => '1989-09-25',
            'email'      => 'example@example.com',
            'age'        => 31,
            'attribute'  => 1,
            'comment'    => "this is hogehoge"
        ];


        $profile = $this->userService->updateProfile($updateUser, $user[0]->id);
        $this->assertDatabaseHas('users', $compareUserData);
    }

    /**
     * userの名前更新ができること
     */
    public function test_名前が更新できること()
    {
        $user = factory(User::class, 1)->create();
        $updateFirstName = 'mami';

        $firstName = new UserFirstName($updateFirstName);
        $id = new UserId($user[0]->id);

        $this->userService->updateUserFirstName($firstName, $id);
        $fetchUserFirstName = $this->userRepository->fetchUser($user[0]->id)->first_name;
        
        $this->assertEquals($fetchUserFirstName, $updateFirstName);
    
    }

    /**
     * userの苗字を更新ができること
     */
    public function test_苗字が更新できること()
    {
        $user = factory(User::class, 1)->create();
        $updateLastName = 'kobayashi';

        $this->userService->updateUserLastName($updateLastName, $user[0]->id);
        $fetchUserLastName = $this->userRepository->fetchUser($user[0]->id)->last_name;
        
        $this->assertEquals($fetchUserLastName, $updateLastName);
    }

    /**
     * userの電話番号を更新ができること
     */
    public function test_電話番号が更新できること()
    {
        $user = factory(User::class, 1)->create();
        $updatetel = '090-7777-8888';

        $this->userService->updateUserTel($updatetel, $user[0]->id);
        $userTel = $this->userRepository->fetchUser($user[0]->id)->tel;
        
        $this->assertEquals($userTel, $updatetel);
    }

    /**
     * userの年齢を更新ができること
     */
    public function test_年齢が更新できること()
    {
        $user = factory(User::class, 1)->create();
        $updateAge = 32;

        $this->userService->updateUserAge($updateAge, $user[0]->id);
        $userAge = $this->userRepository->fetchUser($user[0]->id)->age;
        
        $this->assertEquals($userAge, $updateAge);
    }

    /**
     * userの年齢を更新ができること
     */
    public function test_説明文が更新できること()
    {
        $user = factory(User::class, 1)->create();
        $updateComment = "hogehoge";

        $this->userService->updateUserComment($updateComment, $user[0]->id);
        $fetchUserComment = $this->userRepository->fetchUser($user[0]->id)->comment;
        
        $this->assertEquals($fetchUserComment, $updateComment);
    }

    /**
     * userの誕生日を更新ができること
     */
    public function test_誕生日が更新できること()
    {
        $user = factory(User::class, 1)->create();
        $updateBirthDay = "1989-09-25";
        $parseDate = Carbon::parse($updateBirthDay)->format('Y-m-d'); //Carbon::parse($now)->format('Y-m-d')

        $this->userService->updateUserBirthday($parseDate, $user[0]->id);
        $fetchUserBirthday = $this->userRepository->fetchUser($user[0]->id)->birthday;
        
        Log::debug("birthday", ['birthday' => $fetchUserBirthday]);
        $this->assertEquals($fetchUserBirthday, Carbon::parse($parseDate));
    }

    
}
