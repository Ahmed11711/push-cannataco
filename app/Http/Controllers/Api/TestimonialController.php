<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Services\TestimonialService;
use App\Traits\ApiResponseTrait;

class TestimonialController extends Controller
{
        use ApiResponseTrait;
    
    protected $testimonialService;
    
      public function __construct( TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    public function index()
    {
        $sliders = $this->testimonialService->getAll();
        return $this->successResponse(TestimonialResource::collection($sliders));
    }
}
