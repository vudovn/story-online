<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'author',
        'status_story',
        'status',
        'description',
        'view',
        'feature',
        'cover_url',
    ];


    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function getNewChapterAttribute()
    {
        $chapter = $this->chapters()->orderBy('index', 'desc')->first();
        return $chapter ? $chapter->index : null;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'story_category');
    }

    public function readingHistory()
    {
        return $this->hasMany(ReadingHistory::class);
    }


}