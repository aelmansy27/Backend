<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogArchive extends Model
{
    use HasFactory;

    protected $table = 'activity_log_archives';

    protected $casts = [
        'properties' => 'collection',
    ];
}
