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

        foreach ($data as $movie) {
            foreach($movie->info['cardImages'] as $cardImage) {
                downloadAndStoreImageResource($cardImage['url']);
            }
        }

//        foreach ($data as $element) {
//
//            if(isset($element['cardImages']))
//                foreach ($element['cardImages'] as $cardImage){
////                    var_dump($cardImage['url'], "<br/><br/>");
////                    $image = file_get_contents($cardImage['url']);
////                    Storage::disk('public')->put($element['id'], $image);
//                }
//
//            if(isset($element['keyArtImages']))
//                foreach ($element['keyArtImages'] as $keyArtImage){
////                    var_dump($keyArtImage['url']);
//                }
//
//
//            if(isset($element['videos']))
//                foreach ($element['videos'] as $videoInfo){
//                    if(isset($videoInfo['alternatives']))
//                        foreach ($videoInfo['alternatives'] as $video){
////                            var_dump($video['url'], "<br/><br/>");
//                        }
//                }
//        }

//        exit();

//        var_dump($data);
//        exit();

        /*$toLookFor = [
            'skyGoUrl', 'url', 'reviewAuthor', 'id', 'cert',
            ['key' => 'viewingWindow'],
            'headline',
            ['key' => 'cardImages', 'keys' => ''],
            ['key' => 'directors'],
            'sum',
            ['key' => 'keyArtImages'],
            'synopsis', 'body',
            ['key' => 'cast', 'keys' => 'name'],
            'skyGoId', 'year', 'duration', 'rating', 'class',
            ['key' => 'videos'],
            'lastUpdated',
            ['key' => 'genres'],
            'quote'
        ];

        foreach ($data as $element){
            $movie = new Movie();
            foreach ($toLookFor as $key)
                if(is_string($key))
                    if(isset($element[$key])) {
                        $movie->{snake_case($key)} = $element[$key];
                    }
            $movie->save();
        }*/

        return view('index', [

            'data' => $data,

        ]);

    }

    public function view(Request $request, $id){

//        $movie = DB::table("movies")->where('info->id', $id)->first();
        $movie = Movie::where('info->id', $id)->first();

        foreach($movie->info['cardImages'] as $keyArtImage) {
            downloadAndStoreImageResource($keyArtImage['url'], $keyArtImage['w'], $keyArtImage['h']);
        }

        foreach($movie->info['keyArtImages'] as $keyArtImage) {
            downloadAndStoreImageResource($keyArtImage['url'], $keyArtImage['w'], $keyArtImage['h']);
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
