<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    use ApiResponseTrait;
    
    public function sendEmail(Request $request)
    {
       
        return response()->json(['message' => 'Email sent successfully!']);
    }
}
