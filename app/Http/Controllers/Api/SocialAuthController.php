<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\Merchant;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialMerchant = Socialite::driver($provider)->stateless()->user();

            $merchant = Merchant::where('email', $socialMerchant->getEmail())->first();

            if (!$merchant) {
                $merchant = Merchant::create([
                    'name' => ['en' => $socialMerchant->getName() ?? $socialMerchant->getNickname()],
                    'email' => $socialMerchant->getEmail(),
                    "{$provider}_id" => $socialMerchant->getId(),
                    'password' => bcrypt(Str::random(16)),
                    'status' => true,
                ]);
            }

            $token = $merchant->createToken("{$provider}-token")->plainTextToken;

            return response()->json([
                'merchant' => $merchant,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
