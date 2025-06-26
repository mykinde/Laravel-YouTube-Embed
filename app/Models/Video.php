<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
   protected $fillable = ['title', 'youtube_url', 'thumbnail_url', 'visit_count'];


    public function getYoutubeEmbedUrlAttribute()
    {
        parse_str(parse_url($this->youtube_url, PHP_URL_QUERY), $params);
        return 'https://www.youtube.com/embed/' . ($params['v'] ?? '');
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}
}
