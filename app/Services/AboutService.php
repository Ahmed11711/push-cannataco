<?php

namespace App\Services;

use App\Models\About;

class AboutService
{

    public function getFirst(): ?About
    {
        return About::with(['histories', 'seo'])->first();
    }
}
