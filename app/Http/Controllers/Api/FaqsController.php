<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqsResource;
use App\Services\FaqsService;
use App\Traits\ApiResponseTrait;

class FaqsController extends Controller
{
    use ApiResponseTrait;

    protected $faqsService;

    public function __construct(FaqsService $faqsService)
    {
        $this->faqsService = $faqsService;
    }

    public function index()
    {
        $faqs = $this->faqsService->getAll();
        return $this->successResponse(FaqsResource::collection($faqs));
    }
}
