<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ADD THIS


class Post extends Model
{
    use HasFactory, SoftDeletes; // ADD SoftDeletes HERE
protected $fillable = [
    'title',
    'slug',
    'content',
    'product_name', // Changed from 'excerpt'
    'featured_image',
    'is_published',
    'published_at',
    'user_id',
    'category_id',
    'brand_id',
    'tags'
];
     protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add category relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Add brand relationship
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Add published scope
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now());
    }

    // Add draft scope (optional but useful)
    public function scopeDraft($query)
    {
        return $query->where('is_published', false)
                     ->orWhereNull('published_at')
                     ->orWhere('published_at', '>', now());
    }
    public function scopeProducts($query)
{
    return $query->whereNotNull('product_name')
                 ->whereNotNull('featured_image');
}
}
