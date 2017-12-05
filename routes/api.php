<?php

use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('image/{src}', function ($src){

    $image = getImageResource($src);

    if($image == null)
        return;

    $response = Response::make($image, 200);
    $response->header("Content-Type", 'image/jpeg');

    return $response;


//    return response()->file();
})->name('api.image');

Route::get('video/{src}', function ($src){

    $video = getVideoResource($src);

    if($video == null)
        return;

    $response = Response::make($video, 200);
    $response->header("Content-Type", 'video/mp4');
    $response->header("Content-Length", strlen($video));

    return $response;

})->name('api.video');
