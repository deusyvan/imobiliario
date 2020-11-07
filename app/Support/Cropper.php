<?php
namespace Laradev\Support;

class Cropper
{
    public static function thumb(string $uri, int $widht, int $height = null)
    {
        $cropper = new \CoffeeCode\Cropper\Cropper('../public/storage/cache');
        $pathThumb = $cropper->make(config('filesystems.disks.public.root').'/'.$uri,$widht,$height);
        $file = 'cache/'. collect(explode('/',$pathThumb))->last();
        return $file;
    }

    public static function flush(?string $path)
    {
        $cropper = new \CoffeeCode\Cropper\Cropper('../public/storage/cache'); 

        if(!empty($path)){
            $cropper->flush($path);
        }else{
            $cropper->flush();
        }
    }
}