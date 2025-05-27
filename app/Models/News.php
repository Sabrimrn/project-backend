<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'publication_date',
        'is_published',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'publication_date' => 'date',
            'is_published' => 'boolean',
        ];
    }

    // Relations
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image 
            ? asset('storage/news_images/' . $this->image)
            : asset('images/default-news.jpg');
    }

}
