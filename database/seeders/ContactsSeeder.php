<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsSeeder extends Seeder
{
    public function run(): void
    {
        Contact::create([
            'name' => 'Mohamed Fawzy',
            'email' => 'mohamed@example.com',
            'phone' => '0123456789',
            'subject' => 'استفسار عن الخدمات',
            'message' => 'هل يمكنكم تطوير موقع تجارة إلكترونية متكامل؟',
            'is_read' => false,
            'is_replied' => false,
        ]);

        Contact::create([
            'name' => 'Sara Ahmed',
            'email' => 'sara@example.com',
            'phone' => null,
            'subject' => 'اقتراح',
            'message' => 'أقترح إضافة خاصية المحادثة المباشرة بالموقع.',
            'is_read' => true,
            'is_replied' => true,
            'reply' => 'شكرًا لاقتراحك، سيتم عرضه على الإدارة.',
        ]);
    }
}
