<?php

namespace Laradev;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laradev\Support\Cropper;

class PropertyImage extends Model
{
    protected $fillable = [
        'property',
        'path',
        'cover'
    ];

    //Mutate de url de path para mostrar o caminho da imagem correto no sistema através do storage
    public function getUrlCroppedAttribute()
    {
        return Storage::url(Cropper::thumb($this->path,1366,768));
    }
}
