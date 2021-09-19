<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository\UserRepositoryInterFace;
// use App\UseCases\User\UserUseCaseInterFace;
use  App\UseCases\User\UserUseCase;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private $usecase;

    public function __construct(UserUseCase $usecase)
    {
        $this->usecase = $usecase;
    }
    public function index()
    {
        $test = $this->usecase->getUser();
        return view('test', $test);
    }
}
