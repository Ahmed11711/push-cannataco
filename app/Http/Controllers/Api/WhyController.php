<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WhyResource;
use App\Models\Why;
use App\Services\WhyService;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;


class WhyController extends Controller
{

        use ApiResponseTrait;
    
    protected $whyService;
    
      public function __construct( WhyService $whyService)
    {
        $this->whyService = $whyService;
    }

    public function index()
    {
        $sliders = $this->whyService->getAll();
        return $this->successResponse(WhyResource::collection($sliders));
    }
}
