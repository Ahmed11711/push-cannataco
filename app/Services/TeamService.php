<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public function getAll()
    {
        return Team::all();
    }

}
