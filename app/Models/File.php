<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    protected $fillable = [
        'filename',
        'filename_original',
        'mime', 'extension',
        'size', 'md5',
        'relation', 'foreign_id'
    ];
}
