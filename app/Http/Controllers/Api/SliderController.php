<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Services\SliderService;
use App\Traits\ApiResponseTrait;

class SliderController extends Controller
{

    use ApiResponseTrait;
    
    protected $sliderService;
    
      public function __construct( SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        $sliders = $this->sliderService->getAll();
        return $this->successResponse(SliderResource::collection($sliders));
    }
}
