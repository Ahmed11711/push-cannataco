<?php

namespace App\Services;

use App\Models\Testimonial;

class TestimonialService
{
    public function getAll()
    {
        return Testimonial::all();
    }

}
