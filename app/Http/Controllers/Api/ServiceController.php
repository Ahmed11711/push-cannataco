<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Services\ServiceService;
use App\Traits\ApiResponseTrait;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $services = $this->serviceService->getAll();
        return $this->successResponse(ServiceResource::collection($services));
    }

      public function show(int $id)
    {
        try {
            $service = $this->serviceService->show($id);
            return $this->successResponse(new ServiceResource($service));
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Service not found', 404);
        }
    }
}
