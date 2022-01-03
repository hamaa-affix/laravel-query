<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
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
    public function getProfileAtUser(): JsonResponse
    {
        try {
            $user = auth()->user();
            $profile = $this->userService->getProfile($user->id);

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

    /**
     * userProfile 情報を更新します
     */
    public function updataProfile(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function () use($request, $user) {
                $this->userService->updateProfile($request->all(), $user->id);
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
        ]);
    }

    /**
     * userの名前を更新します
     */
    public function updateFirstName(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function() use ($request, $user) {
                $this->userService->updateUserFirstName($request->firstName, $user->id);
            });

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);

            return response()->json([
                'message' => trans('message.success.user.update'),
                'status' => Response::HTTP_OK
            ]);
        }
    }

    /**
     * userの苗字を更新します
     */
    public function updateLastName(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function() use ($request, $user) {
                $this->userService->updateUserLastName($request->LastName, $user->id);
            });

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);

            return response()->json([
                'message' => trans('message.success.user.update'),
                'status' => Response::HTTP_OK
            ]);
        }
    }

    /**
     * userの電話番号を更新します
     */
    public function updateUserTel(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function() use ($request, $user) {
                $this->userService->updateUserTel($request->tel, $user->id);
            });

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);

            return response()->json([
                'message' => trans('message.success.user.update'),
                'status' => Response::HTTP_OK
            ]);
        }
    }

    /**
     * userのemailを更新します
     */
    public function updateUserEmail(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function() use ($request, $user) {
                $this->userService->updateUserEmail($request->email, $user->id);
            });

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);

            return response()->json([
                'message' => trans('message.success.user.update'),
                'status' => Response::HTTP_OK
            ]);
        }
    }

    /**
     * userの年齢を更新します
     */
    public function updateUserAge(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function() use ($request, $user) {
                $this->userService->updateUserAge($request->age, $user->id);
            });

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);

            return response()->json([
                'message' => trans('message.success.user.update'),
                'status' => Response::HTTP_OK
            ]);
        }
    }

    /**
     * userの誕生日を更新します
     */
    public function updateUserBirthday(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function() use ($request, $user) {
                $this->userService->updateUserBirthday($request->birthday, $user->id);
            });

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);

            return response()->json([
                'message' => trans('message.success.user.update'),
                'status' => Response::HTTP_OK
            ]);
        }
    }


    /**
     * userの説明文を更新します
     */
    public function updateUserComment(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();

            DB::transaction(function() use ($request, $user) {
                $this->userService->updateUserComment($request->comment, $user->id);
            });

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => trans('message.error.user.update'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);

            return response()->json([
                'message' => trans('message.success.user.update'),
                'status' => Response::HTTP_OK
            ]);
        }
    }
}
