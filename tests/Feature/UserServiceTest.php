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
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory(1)->create();
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
        $profile = $this->userService->getProfile($this->user[0]->id);

        $userData = [
            'fullName' => $this->user[0]->last_name. $this->user[0]->first_name,
            'age' => $this->user[0]->age,
            'birthday' => $this->user[0]->birthday,
            'attribute' => $this->user[0]->attribute,
            'email' => $this->user[0]->email,
            'tel' => $this->user[0]->tel,
        ];
        $this->assertEquals($userData, $profile);

    }

    /**
     * user情報の更新ができること
     * @test
     */
    public function test_user情報を更新できること()
    {
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


        $profile = $this->userService->updateProfile($updateUser, $this->user[0]->id);
        $this->assertDatabaseHas('users', $compareUserData);
    }

    /**
     * userの名前更新ができること
     */
    public function test_名前が更新できること()
    {
        $updateFirstName = 'mami';

        $firstName = new UserFirstName($updateFirstName);
        $id = new UserId($this->user[0]->id);

        $this->userService->updateUserFirstName($firstName, $id);
        $fetchUserFirstName = $this->userRepository->fetchUser($this->user[0]->id)->first_name;

        $this->assertEquals($fetchUserFirstName, $updateFirstName);

    }

    /**
     * userの苗字を更新ができること
     */
    public function test_苗字が更新できること()
    {
        $updateLastName = 'kobayashi';

        $this->userService->updateUserLastName($updateLastName, $this->user[0]->id);
        $fetchUserLastName = $this->userRepository->fetchUser($this->user[0]->id)->last_name;

        $this->assertEquals($fetchUserLastName, $updateLastName);
    }

    /**
     * userの電話番号を更新ができること
     */
    public function test_電話番号が更新できること()
    {
        $updatetel = '090-7777-8888';

        $this->userService->updateUserTel($updatetel, $this->user[0]->id);
        $userTel = $this->userRepository->fetchUser($this->user[0]->id)->tel;

        $this->assertEquals($userTel, $updatetel);
    }

    /**
     * userの年齢を更新ができること
     */
    public function test_年齢が更新できること()
    {
        $updateAge = 32;

        $this->userService->updateUserAge($updateAge, $this->user[0]->id);
        $userAge = $this->userRepository->fetchUser($this->user[0]->id)->age;

        $this->assertEquals($userAge, $updateAge);
    }

    /**
     * userの年齢を更新ができること
     */
    public function test_説明文が更新できること()
    {
        $updateComment = "hogehoge";

        $this->userService->updateUserComment($updateComment, $this->user[0]->id);
        $fetchUserComment = $this->userRepository->fetchUser($this->user[0]->id)->comment;

        $this->assertEquals($fetchUserComment, $updateComment);
    }

    /**
     * userの誕生日を更新ができること
     */
    public function test_誕生日が更新できること()
    {
        $updateBirthDay = "1989-09-25";
        $parseDate = Carbon::parse($updateBirthDay)->format('Y-m-d'); //Carbon::parse($now)->format('Y-m-d')

        $this->userService->updateUserBirthday($parseDate, $this->user[0]->id);
        $fetchUserBirthday = $this->userRepository->fetchUser($this->user[0]->id)->birthday;

        Log::debug("birthday", ['birthday' => $fetchUserBirthday]);
        $this->assertEquals($fetchUserBirthday, Carbon::parse($parseDate));
    }


}
