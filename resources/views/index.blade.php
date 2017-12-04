<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>

<body>

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

</body>

</html>
