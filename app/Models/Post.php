<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->post_content));
        $minutes = ceil($wordCount / 200);

        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' read';
    }
}
