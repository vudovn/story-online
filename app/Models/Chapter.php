<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'title',
        'slug',
        'content',
        'index',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function readingHistory()
    {
        return $this->hasMany(ReadingHistory::class);
    }
}