<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $table='notes';
    protected $fillable=[
        'note_id',
        'cow_id',

        'title',
        'body'
    ];



    public function cow()
    {
        return $this->belongsTo(Cow::class, 'note_id');
    }
}
