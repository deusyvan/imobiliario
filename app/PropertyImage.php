<?php

namespace Laradev;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = [
        'property',
        'path',
        'cover'
    ];
}
