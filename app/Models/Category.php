<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
    ];

    public function stories()
    {
        return $this->belongsToMany(Story::class, 'story_category');
    }

    public function getStoriesCountAttribute()
    {
        return $this->stories->count();
    }

}