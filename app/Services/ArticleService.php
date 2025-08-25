<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
  public function getAll()
{
    return Article::with('seo')->get();
}

    public function getById($id)
    {
        return Article::findOrFail($id);
    }
   public function getBySlug(string $slug)
    {
        return Article::where('slug', $slug)->firstOrFail();
    }
  
}
