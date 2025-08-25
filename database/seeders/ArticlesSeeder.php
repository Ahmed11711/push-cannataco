<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesSeeder extends Seeder
{
    public function run(): void
    {
        Article::create([
            'title' => [
                'en' => 'The Importance of Web Performance',
                'ar' => 'أهمية أداء المواقع الإلكترونية'
            ],
            'content' => [
                'en' => 'Web performance affects user experience and SEO rankings significantly...',
                'ar' => 'أداء المواقع يؤثر بشكل كبير على تجربة المستخدم وترتيب الموقع في محركات البحث...'
            ],
            'slug' => 'web-importance',
            'image' => 'articles/web-performance.jpg',
            'image_alt' => 'Article about web performance',
            'is_published' => true,
        ]);

        Article::create([
            'title' => [
                'en' => 'Laravel Tips for Scalable Applications',
                'ar' => 'نصائح Laravel لتطبيقات قابلة للتوسع'
            ],
            'content' => [
                'en' => 'Here are practical tips to keep your Laravel apps scalable and maintainable...',
                'ar' => 'فيما يلي نصائح عملية لجعل تطبيقات Laravel قابلة للتوسع وسهلة الصيانة...'
            ],
            'slug' => 'laravel-tips',
            'image' => 'articles/laravel-tips.jpg',
            'image_alt' => 'Laravel tips article',
            'is_published' => false,
        ]);
    }
}
