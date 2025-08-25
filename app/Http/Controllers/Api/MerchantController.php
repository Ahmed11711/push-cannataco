<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantRequest;
use App\Services\MerchantService;
use App\Http\Resources\MerchantResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class MerchantController extends Controller
{
    use ApiResponseTrait;

    protected $merchantService;

    public function __construct(MerchantService $merchantService)
    {
        $this->merchantService = $merchantService;
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $merchant = $this->merchantService->handleSocialCallback($provider);

        $token = $merchant->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'merchant' => new MerchantResource($merchant),
            'token' => $token,
        ], 'login' . ucfirst($provider));
    }


    public function register(MerchantRequest $request)
    {
        $validated = $request->validated();
        $merchant = $this->merchantService->register($validated);
        $token = $merchant->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'merchant' => new MerchantResource($merchant),
            'token'    => $token,
        ], 'Merchant registered successfully.', 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'google_id', 'facebook_id');

        $merchant = $this->merchantService->login($credentials);

        if (!$merchant) {
            return $this->errorResponse('بيانات الدخول غير صحيحة', 401);
        }

        $token = $merchant->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'merchant' => new MerchantResource($merchant),
            'token'    => $token,
        ], 'تم تسجيل الدخول بنجاح');
    }

public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return $this->successResponse([], 'تم تسجيل الخروج بنجاح');
}

}
