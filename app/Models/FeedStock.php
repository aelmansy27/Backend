<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedStock extends Model
{
    use HasFactory;

    public function cowFeeds()
    {
        return $this->hasMany(CowFeed::class);
    }
}
