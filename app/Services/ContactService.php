<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function store(array $data)
    {
        $contact = Contact::create($data);
        return $contact;
    }

}
