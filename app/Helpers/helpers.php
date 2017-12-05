<?php
use Illuminate\Http\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Created by PhpStorm.
 * User: victor
 * Date: 23.11.2017
 * Time: 12:55
 */

function getDataFromUrl($url){
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    return $output;
}

function getImageResource($basename){
    if(Cache::get($basename) == '#')
        return null;

    if(Cache::has($basename))
        return Cache::get($basename);

    return null;
}

function getVideoResource($basename){
    if(Cache::get($basename) == '#')
        return null;

    if(Cache::has($basename))
        return Cache::get($basename);

    return null;
}

function downloadAndStoreVideoResource($url){

    $basename = basename($url);

    if(Cache::has($basename))
        return;

    $resource = downloadResource($url);

    if($resource != null)
        Cache::put($basename, $resource, config('challenge.cache.timeout'));

    else
        Cache::put($basename, "#", config('challenge.cache.timeout'));
}

function downloadAndStoreImageResource($url, $width = 100, $height = 100){

    $basename = basename($url);

    if(Cache::has($basename))
        return;

    /* this is added because of the file naming pattern as an observed optimisation */
    if(($strpos = strpos($basename, '-LPA-to')) !== false || ($strpos = strpos($basename, '-VPA-to')) !== false){
        $resource_name = substr($basename, 0, $strpos).'.'.pathinfo($url)['extension'];

        if(Cache::get($resource_name)) {
            Cache::put($basename, "#", config('challenge.cache.timeout'));
            return;
        }

        $resource = (string)Image::make(Cache::get($resource_name))->resize($width, $height)->encode('jpg');

        Cache::put($basename, $resource, config('challenge.cache.timeout'));
    }

    $resource = downloadResource($url);

    if($resource != null)
        Cache::put($basename, $resource, config('challenge.cache.timeout'));

    else
        Cache::put($basename, "#", config('challenge.cache.timeout'));
}

function downloadResource($url){
    try {
        return file_get_contents($url);
    }catch (Exception $ex){
        return null;
    }
}
?>