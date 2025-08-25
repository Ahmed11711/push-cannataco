<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ApiResponseTrait;
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = $this->articleService->getAll();
        return $this->successResponse(ArticleResource::collection($articles));
    }

    public function show($slug)
    {
        $article = $this->articleService->getBySlug($slug);
        return $this->successResponse(new ArticleResource($article));
    }

}
