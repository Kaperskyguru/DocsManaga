<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_id', 'filename', 'type',
    ];

    // public function files()
    // {
    //     return $this->belongsTo('App\Document', 'id', 'document_id');
    // }

}
