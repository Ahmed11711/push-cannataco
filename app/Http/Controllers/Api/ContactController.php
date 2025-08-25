<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Services\ContactService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponseTrait;
    protected $contactService;
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    public function store(ContactRequest $request)
    {
        $data = $request->validated();
        $contact = $this->contactService->store($data);
        return $this->successResponse(new ContactResource($contact), 'Contact created successfully', 201);
    }
}
