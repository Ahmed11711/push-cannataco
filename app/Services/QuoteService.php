<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Quote;

class QuoteService
{
    public function store(array $data)
    {
        $qoute = Quote::create($data);
        return $qoute;
    }

}
