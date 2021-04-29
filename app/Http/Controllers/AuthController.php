<?php


namespace App\Http\Controllers;


use App\Http\Request\Admin\AdminLoginRequest;
use App\Http\Request\Client\ClientLoginRequest;
use App\Http\Request\Client\SignupCodeRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\ClientAuthService;
use App\Services\Auth\SignupCodeService;
use App\Services\Auth\UserAuthService;
use Illuminate\Http\JsonResponse;

final class AuthController extends Controller
{
    private $clientAuthService,$userAuthService,$codeService;

    public function __construct(ClientAuthService $clientAuthService, UserAuthService $userAuthService,SignupCodeService $codeService)
    {
        $this->clientAuthService = $clientAuthService;
        $this->userAuthService = $userAuthService;
        $this->codeService = $codeService;
    }

    public function signupCode(SignupCodeRequest $request): JsonResponse
    {
        $code = $this->codeService->sendCode( $request->phone );

        return response()->json([
           'message' => 'Code was sended to a given phone.',
           'code'    => $code,
        ],200);
    }


    public function clientLogin(ClientLoginRequest $request)
    {
        $tokenResult = $this->clientAuthService->login($request->only('phone', 'password'));

        if (!$tokenResult) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = auth()->guard('client')->user();

        return UserResource::make($user)->additional([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function userLogin(AdminLoginRequest $request)
    {
        $tokenResult = $this->userAuthService->login($request->only('email', 'password'));

        if (!$tokenResult) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = auth()->guard('user')->user();

        return UserResource::make($user)->additional([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer'
        ]);

    }
}
