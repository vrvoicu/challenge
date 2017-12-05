<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 02.12.2017
 * Time: 08:39
 */

?>
@extends('app')

@section('content')
    <div class="container-fluid">

        @if($movie->info['headline'])
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{ $movie->info['headline'] }}</h1>
                </div>
            </div>
        @endif

        @if(isset($movie->info['cardImages']))
            <div class="row">
                @foreach($movie->info['cardImages'] as $cardImage)
                    <div class="col-xs-12">
{{--                        <img src="{{ $cardImage['url'] }}">--}}
{{--                        <img src="{{ getResource($cardImage['url']) }}"/>--}}
                        <img src="{{ route('api.image', ['name' => basename($cardImage['url'])]) }}"/>
                        {{--<img src="api/storage/bla.jpg"/>--}}

                    </div>
                @endforeach
            </div>
        @endif

        <div class="row">
            @if(isset($movie->info['year']))
                <div class="col-xs-1">
                    {{ trans('labels.year') }}: {{ $movie->info['year'] }}
                </div>
            @endif

            @if(isset($movie->info['duration']))
                <div class="col-xs-1">
                    {{ trans('labels.duration') }}: {{ $movie->info['duration'] / 60 }}
                </div>
            @endif

            @if(isset($movie->info['cert']))
                <div class="col-xs-1">
                    {{ trans('labels.certificate') }}: {{ $movie->info['cert'] }}
                </div>
            @endif

            @if(isset($movie->info['rating']))
                <div class="col-xs-1">
                    {{ trans('labels.rating') }}: {{ $movie->info['rating'] }}
                </div>
            @endif
        </div>

        <div class="row">

            <div class="col-xs-1">
                @if(isset($movie->info['keyArtImages']))
                    <div class="row">
                        @foreach($movie->info['keyArtImages'] as $keyArtImage)
                            <div class="col-xs-12">
{{--                                <img src="{{ $keyArtImage['url'] }}"/>--}}
{{--                                <img src="{{ getResource(\App\Models\Resources::TYPE_IMAGE, $keyArtImage['url']) }}"/>--}}
                                <img src="{{ route('api.image', ['name' => basename($keyArtImage['url'])]) }}"/>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(isset($movie->info['synopsis']))
                <div class="col-xs-4">
                    <p>{{ trans('labels.synopsis') }}</p>
                    <p>{{ $movie->info['synopsis'] }}</p>
                </div>
            @endif

            @if(isset($movie->info['cast']))
                <div id="cast" class="col-xs-1">
                    <p>{{ trans('labels.cast') }}</p>
                    @foreach($movie->info['cast'] as $actor)
                        <p>{{ $actor['name'] }}</p>
                    @endforeach
                </div>
            @endif

            @if(isset($movie->info['directors']))
                <div id="directors" class="col-xs-1">
                    <p>{{ trans('labels.directors') }}</p>
                    @foreach($movie->info['directors'] as $director)
                        <p>{{ $director['name'] }}</p>
                    @endforeach
                </div>
            @endif

        </div>

        @if(isset($movie->info['videos']))
            <div class="row">
                @foreach($movie->info['videos'] as $video)
                    <div class="col-xs-2">
                        <p>{{ $video['title'] }}: {{ $video['type'] }}</p>
                        <video width="320" height="240" controls>
                            <source src="{{ route('api.video', ['name' => basename($video['url'])]) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
