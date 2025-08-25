<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Services\TeamService;
use App\Traits\ApiResponseTrait;


class TeamController extends Controller
{
 use ApiResponseTrait;

    protected $faqsService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function index()
    {
        $faqs = $this->teamService->getAll();
        return $this->successResponse(TeamResource::collection($faqs));
    }
}
