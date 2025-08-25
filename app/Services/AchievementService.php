<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Collection;
class AchievementService
{

      public function all(): Collection
    {
        return Achievement::all();
    }
}
