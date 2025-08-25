<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AboutResource;
use App\Services\AboutService;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;

class AboutController extends Controller
{
    use ApiResponseTrait;
    protected $aboutService;
    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }
    public function index()
    {
        $about = $this->aboutService->getFirst();
        return $this->successResponse(new AboutResource($about));
    }


}
