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

function getResource($url){

    $basename = basename($url);

    if(Cache::has($basename))
        return Cache::get($basename);

    if(Storage::disk('public')->exists($basename)){
        $image = Storage::disk('public')->get($basename);
        Cache::put($basename, $image);
        return $image;
    }

//    $image = downloadResource($url);

//    if($image != null)
//        return $image;
}

function getImageResource($basename){
    if(Cache::get($basename) == '#')
        return null;

    if(Cache::has($basename))
        return Cache::get($basename);

    if(Storage::disk('public')->exists($basename)){
        $image = Storage::disk('public')->get($basename);
        Cache::put($basename, $image, 10);
        return $image;
    }
//    if($image != null)
//        return $image;

//    strpos('VPA-to', 'LPA-to');
}

function getVideoResource($basename){
    if(Cache::get($basename) == '#')
        return null;

    return Storage::disk('public')->get($basename);
}

function downloadAndStoreVideoResource($url){

    $basename = basename($url);

    if(Cache::has($basename))
        return Cache::get($basename);

    $resource = downloadResource($url);

    if($resource != null) {

        Cache::put($basename, $resource, 10);
        return $resource;

    }
    else{
        var_dump("download: ", $basename);
        return Cache::put($basename, "#", 10);
    }
}

function downloadAndStoreImageResource($url, $width = 100, $height = 100){

    $basename = basename($url);

    if(Cache::has($basename))
        return Cache::get($basename);

    if(($strpos = strpos($basename, '-LPA-to')) !== false || ($strpos = strpos($basename, '-VPA-to')) !== false){
        $resource_name = substr($basename, 0, $strpos).'.'.pathinfo($url)['extension'];
        
        $resource = (string)Image::make(Cache::get($resource_name))->resize($width, $height)->encode('jpg');

        Cache::put($basename, $resource, 10);

        return $resource;
    }

    $resource = downloadResource($url);

    if($resource != null){

        if(!Storage::disk('public')->exists($basename))
            Storage::disk('public')->put($basename, $resource);

        Cache::put($basename, $resource, 10);

        return $resource;
    }

    else{

        var_dump("download: ", $basename);

        return Cache::put($basename, "#", 10);

    }

    /*$basename = basename($url);

    if(Cache::has($basename))
        return Cache::get($basename);

    $resource = downloadImageResource($url);

    if($resource != null){

        if(!Storage::disk('public')->exists($basename))
            Storage::disk('public')->put($basename, $resource);

        if(!Cache::has($basename))
            Cache::put($basename, $resource, 10);

        return $resource;
    }

    else if (($strpos = strpos($basename, '-LPA-to')) !== false || ($strpos = strpos($basename, '-VPA-to')) !== false){
        $resource_name = substr($basename, 0, $strpos).'.'.pathinfo($url)['extension'];

        $resource = (string)Image::make(Cache::get($resource_name))->resize($width, $height)->encode('jpg');
        Image::make(Cache::get($resource_name))->resize($width, $height)->save(storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'bbb.jpg');

        if(!Cache::has($basename))
            Cache::put($basename, $resource, 10);

        return $resource;
    }
    else{

        if(!Cache::has($basename))
            return Cache::put($basename, null, 10);

    }*/
}

function downloadResource($url){
    try {
        return file_get_contents($url);
    }catch (Exception $ex){
        return null;
    }
}
?>