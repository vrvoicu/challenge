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

//Route::get('image/{name}', function (Request $request){
//    return response()->file();
//    var_dump("aaaa");
//    exit();
////    var_dump($request->input());
////    exit();
////    \Illuminate\Support\Facades\Cache::get()
//})->name('resource.image');

Route::get('video', function (Request $request){

});

Route::get('image/{src}', function ($src){

    $image = getImageResource($src);

    $response = Response::make($image, 200);
    $response->header("Content-Type", 'image/jpeg');

    return $response;


//    return response()->file();
})->name('api.image');
