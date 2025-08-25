<?php

namespace App\Services;

use App\Models\How;

class HowService
{
    public function getAll()
    {
        return How::all();
    }

    public function show($id)
    {
        return How::findOrFail($id);
    }
}
