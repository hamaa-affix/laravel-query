<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\EloquentUserRepository;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

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
            'familyId' => $user[0]->family_id 
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
        ];
    
        $compareUserData = [
            'first_name'  => 'mami',
            'last_name'   => 'hamada',
            'birthday'   => '1989-09-25',
            'email'      => 'example@example.com',
            'age'        => 31,
            'attribute'  => 1,
        ];


        $profile = $this->userService->updateProfile($updateUser, $user[0]->id);
        $this->assertDatabaseHas('users', $compareUserData);
    }
}
