<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    //

    public function import(){

    }

    public function index(){

//        $url = "https://2bimisc.blob.core.windows.net/technical-test/showcase.json";
//        $data = getDataFromUrl($url);

//        $data = Storage::disk('public')->get("data.json");
//
//        /* error encoding /92 */
//        $data = utf8_encode($data);
//        $data = json_decode($data, true);
//
//        foreach ($data as $element){
//            Movie::create([
//                'id' => $element['id'],
//                'info' => json_encode($element),
//            ]);
//        }

        $data = Movie::all();

        return view('index', [

            'data' => $data,

        ]);

    }

    public function view(Request $request, $id){

//        $movie = DB::table("movies")->where('info->id', $id)->first();
        $movie = Movie::where('info->id', $id)->first();

//        var_dump(json_encode($movie->info));
//        exit();

        foreach($movie->info['cardImages'] as $keyArtImage) {
            downloadAndStoreImageResource($keyArtImage['url'], $keyArtImage['w'], $keyArtImage['h']);
        }

        foreach($movie->info['keyArtImages'] as $keyArtImage) {
//            downloadAndStoreImageResource($keyArtImage['url'], $keyArtImage['w'], $keyArtImage['h']);
        }

        foreach ($movie->info['videos'] as $video){
            downloadAndStoreVideoResource($video['url']);
//            downloadResource($video['url']);
//            foreach ($video['alternatives'] as $videoAlternative){
//
//            }
        }


        return view('movies.view', [
            'movie' => $movie
        ]);

    }

//    public function image(Request $request, $name){
//        var_dump("aaa");
//        $response->header('Content-Type', 'image/png');
//        return response()->file(Storage::disk('public')->get('8ad589013b496d9f013b4c0b684a4a5d'));
//    }
}
