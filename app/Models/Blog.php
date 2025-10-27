<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'status'];

    protected $appends = ['featured_image'];

    protected $hidden = ['media'];

    public function getFeaturedImageAttribute(): string
    {
        $media = $this->getMedia('blog')->first();

        return $media ? $media->getFullUrl() : '';
    }
}
