<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    use ApiResponseTrait;

    protected $SettingService;

    public function __construct(SettingService $SettingService)
    {
        $this->SettingService = $SettingService;
    }

public function index()
{
    $setting = $this->SettingService->first();

    return $this->successResponse(
        new SettingResource($setting),
        'Settings retrieved successfully'
    );
}


}
