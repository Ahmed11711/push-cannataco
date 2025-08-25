<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Services\GalleryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use ApiResponseTrait;
     protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function index()
    {
        $images = $this->galleryService->all();
        return $this->successResponse(GalleryResource::collection($images), 'Gallery images retrieved successfully.');
    }
}
