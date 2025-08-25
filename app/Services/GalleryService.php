<?php

namespace App\Services;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Collection;
class GalleryService
{

      public function all(): Collection
    {
        return Gallery::select('id', 'image')
            ->latest()
            ->get();
    }
}
