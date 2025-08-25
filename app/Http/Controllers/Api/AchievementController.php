<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AchievementResource;
use App\Models\Achievement;
use App\Services\AchievementService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    use ApiResponseTrait;

    protected $achievementService;
    
    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }
    public function index(Request $request)
    {
        $achievements = $this->achievementService->all();

        return $this->successResponse(AchievementResource::collection($achievements), 'Achievements retrieved successfully.');
    }
}
