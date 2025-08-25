<?php

namespace App\Services;

use App\Models\Slider;

class SliderService
{
    public function getAll()
    {
        return Slider::all();
    }

}
