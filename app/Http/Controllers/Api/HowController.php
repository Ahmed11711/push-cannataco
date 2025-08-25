<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HowResource;
use App\Traits\ApiResponseTrait;
use App\Services\HowService;

class HowController extends Controller
{
    use ApiResponseTrait;

    protected $howService;

    public function __construct(HowService $howService)
    {
        $this->howService = $howService;
    }

 public function index()
{
    $hows = $this->howService->getAll();
    return $this->successResponse(HowResource::collection($hows));
}

    public function show($id)
    {
        $how = $this->howService->show($id);
        return $this->successResponse(new HowResource($how));
    }
}
