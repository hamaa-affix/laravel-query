<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\EloquentUserRepository;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserServiceRegisterTest extends TestCase
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
}
