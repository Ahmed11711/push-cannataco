<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
        public function getAll()
    {
        return Service::with('seo')->get();
    }

    public function show($id)
    {
        return Service::with('seo')->findOrFail($id);
    }

}
