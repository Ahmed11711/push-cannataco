<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Services\QuoteService;
use App\Traits\ApiResponseTrait;
use Throwable;
class QuoteController extends Controller
{
    use ApiResponseTrait;
    protected $quoteService;
    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }
    public function store(QuoteRequest $request)
    {
        try {
            $data = $request->validated();
            $quote = $this->quoteService->store($data);

            return $this->successResponse(
                new QuoteResource($quote),
                'Quote created successfully',
                201
            );
        } catch (Throwable $e) {
            return $this->errorResponse(
                'Failed to create quote',
                500,
                ['error' => $e->getMessage()]
            );
        }
    }
}
