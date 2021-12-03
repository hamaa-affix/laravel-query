<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Http\Response;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    private UserServiceInterface $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct
    (
        UserServiceInterface $userServiceInterface
    )
    {
        $this->middleware('guest');
        $this->userService = $userServiceInterface;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'companyName' => ['required', 'string', 'max:255']
        ]);
    }

    public function register(Request $request)
    {
        $validate = $this->validator($request->all());

        //企業登録も行っちゃう。企業情報がなければ、後で保存する？？
        if ($validate->fails()) {
            return new JsonResponse($validate->errors());
        }
        try {
            DB::transaction(function () use ($request) {
                Log::debug("user登録開始");
                $company = $this->userService->registerCompany($request->companyId, $request->all());
                $user = $this->userService->registerUser($request->all(), $company->id);
                Log::debug("user作成！", ['user' => $user]);

                return response()->json([
                    'message' => '登録しました',
                    'status' => Response::HTTP_OK
                ]);
            });
        } catch(\Throwable $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => '登録に失敗しました',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

    }
}
