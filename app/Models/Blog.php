<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'seo_title',
        'meta_description',
        'keyword',
        'status',
    ];

    protected $casts = [
        'keyword' => 'array',
        'category' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_category');
    }
}
