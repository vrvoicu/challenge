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

        $url = "https://2bimisc.blob.core.windows.net/technical-test/showcase.json";

        $data = getDataFromUrl($url);

        /* error encoding /92 */
        $data = utf8_encode($data);
        $data = json_decode($data, true);

        foreach ($data as $element){
            Movie::create([
                'id' => $element['id'],
                'info' => json_encode($element),
            ]);
        }

        return redirect(route('movies.index'));
    }

    public function index(){

        $data = Movie::all();

        return view('movies.index', [

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
}
