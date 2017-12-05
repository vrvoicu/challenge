

@extends('app')

@section('content')

    <div class="container-fluid">

        <ul>
            @foreach($data as $movie)
                <li>
                    <a href="{{ route('movies.view', $movie->id) }}"> {{ $movie->info['headline'] }}</a>
                </li>
            @endforeach
        </ul>

        @foreach($data as $movie)

            @if(isset($element['skyGoUrl']))

                <a href="{{ $element['skyGoUrl'] }}">url</a>

            @endif

            @if(isset($element['"reviewAuthor"']))

                <a href="{{ $element['"reviewAuthor"'] }}">url</a>

            @endif


            @if(isset($element['body']))
                {{ $element['body'] }}
            @endif

            @if(isset($element['quote']))
                {{ $element['quote'] }}
            @endif

            @if(isset($element['lastUpdated']))
                {{ $element['lastUpdated'] }}
            @endif

            @if(isset($element['class']))
                {{ $element['class'] }}
            @endif




            @if(isset($element['genres']))
                @foreach($element['genres'] as $cast)

                @endforeach
            @endif


        @endforeach

    </div>

@endsection
