<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function first()
    {
        return Setting::with('locations')->first();
    }
}
