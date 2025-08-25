<?php

namespace App\Services;

use App\Models\Faqs;

class FaqsService
{
    public function getAll()
    {
        return Faqs::all();
    }

}
