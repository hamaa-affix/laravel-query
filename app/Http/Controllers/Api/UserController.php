<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserServiceInterface $userService;
    
    public function __construct
    (
        UserServiceInterface $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * user情報を返却します。
     *
     * @return void
     */
    public function getProfileAtUser()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $profile = $this->userService->getProfile($user->id);

            if(empty($user)) new Exception('権限ありません');

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        } 

        return response()->json([
            'user' => $profile,
            'status' => Response::HTTP_OK
        ]);
    }

    public function updataProfile(Request $request)
    {
        try {
            DB::transaction(function () use($request) {
                $this->userService->updateProfile($request->all());
            });
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' =>  trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

        return response()->json([
            'message' => trans('message.success.user.update'),
            'status' => Response::HTTP_OK,
        ])
    }
}
