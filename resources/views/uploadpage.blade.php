@extends('layouts.app')

@section('content')

    <div class="container">

        {{--<h1>Upload</h1>--}}

        <uploads></uploads>
        {{--<file-upload></file-upload>--}}

        {{--<paginator></paginator>--}}

    @isset ($path)

            {{$path}}
            {{--<img src="{{ asset('/storage/' . $path) }}">--}}
        @endisset

    </div>

@endsection