<?php

namespace App\Services;

use App\Models\Merchant;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class MerchantService
{
 

public function handleSocialCallback(string $provider): Merchant
{
    $socialUser = Socialite::driver($provider)->stateless()->user();

    $merchant = Merchant::where('email', $socialUser->getEmail())->first();

    if (!$merchant) {
        $merchant = Merchant::create([
            'name' => $socialUser->getName() ?? $socialUser->getNickname(),
            'email' => $socialUser->getEmail(),
            "{$provider}_id" => $socialUser->getId(),
            'password' => Hash::make(Str::random(16)),
        ]);
    }else {
            if (empty($merchant["{$provider}_id"])) {
                $merchant->update(["{$provider}_id" => $socialUser->getId()]);
            }
        }

    return $merchant;
}

    public function register(array $data): Merchant
    {
        $imagePath = null;
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('merchants', 'public');
        }
        return Merchant::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'] ?? null,
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'address_warehouse' => $data['address_warehouse'] ?? null,
            'address_company' => $data['address_company'] ?? null,
            'phone' => $data['phone'] ?? null,
            'phone2' => $data['phone2'] ?? null,
            'image' => $imagePath,
            'description' => $data['description'] ?? null,
            'google_id' => $data['google_id'] ?? null,
            'facebook_id' => $data['facebook_id'] ?? null,
            'status' => $data['status'] ?? false,
        ]);
    }
public function login(array $credentials): ?Merchant
{
    if (!empty($credentials['facebook_id'])) {
        return Merchant::where('facebook_id', $credentials['facebook_id'])->first();
    }

    if (!empty($credentials['google_id'])) {
        return Merchant::where('google_id', $credentials['google_id'])->first();
    }

    if (!empty($credentials['email']) && !empty($credentials['password'])) {
        $merchant = Merchant::where('email', $credentials['email'])->first();
        if ($merchant && Hash::check($credentials['password'], $merchant->password)) {
            return $merchant;
        }
    }

    return null;
}

}
