<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Portfolio extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'content', 'status', 'portfolio_type_id'];

    protected $appends = ['featured_image'];

    protected $hidden = ['media'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(PortfolioType::class, 'portfolio_type_id');
    }

    public function getFeaturedImageAttribute(): string
    {
        $media = $this->getMedia('portfolio')->first();

        return $media ? $media->getFullUrl() : '';
    }
}
