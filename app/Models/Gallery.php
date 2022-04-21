<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ["title", "description"];

    public static function scopeSearchByTitle($query, $title = "")
    {
        if (!$title) {
            return $query;
        }

        return $query->where("title", "like", "%{title}%");
    }

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class);
    }
}