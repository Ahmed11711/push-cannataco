<?php

namespace App\Services;

use App\Models\Why;

class WhyService
{
    public function getAll()
    {
        return Why::all();
    }

}
