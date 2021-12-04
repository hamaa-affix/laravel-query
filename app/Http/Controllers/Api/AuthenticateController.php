<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\UserServiceInterface;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class AuthenticateController extends Controller {

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

    public function register(RegisterRequest $request)
    {
        //企業登録も行っちゃう。企業情報がなければ、後で保存する？？
        try {
            DB::beginTransaction();
            $company = $this->userService->registerCompany($request->companyId, $request->all());
            $user = $this->userService->registerUser($request->all(), $company->id);
            $token = $this->publishToken($request);
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => '登録に失敗しました',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
        return response()->json([
            'user' => $token,
            'message' => '登録しました',
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     *ログインを行ってtokenを返却します
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
        // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
        // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }


    protected function publishToken($request) {
        $token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password]);
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth("api")->factory()->getTTL() * 60
        ]);
    }
}
