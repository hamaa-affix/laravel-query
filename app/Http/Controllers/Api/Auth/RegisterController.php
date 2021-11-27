<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @param Company $company
     * @return \App\User
     */
    protected function create(array $data, Company $company)
    {
        return User::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'company_id' => $company->id,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * 企業を検索して、見つからなければ、作成し返却します。
     * @param int $campanyId
     * @param array $companyData
     * @return Company
     */
    protected function registerCampany(int $companyId = null, array $companyData): Company
    {
        Log::debug("会社登録開始", ['compant_data' => $companyData]);
        $company = Company::find($companyId);

        if(empty($company)) {
            return Company::create($companyData);
        }

        return $company;
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
                $company = [
                    'name' => $request->companyName
                ];
                Log::debug("comapanyId", ['id' => $request->companyId]);
                $company = $this->registerCampany($request->companyId, $company);
                event(new Registered($user = $this->create($request->all(), $company)));

                Log::debug("user作成！", ['user' => $user]);
                return response()->json([
                    'message' => '登録しました'
                ], 200);
            });
        } catch(\Throwable $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => '登録に失敗しました'
            ], 500);
        }

    }
}
