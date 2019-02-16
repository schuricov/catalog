@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Download page</h1>

        {{--<form action="/image/upload" method="post" enctype="multipart/form-data">--}}
        <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
        @csrf

            <div class="form-group">
                <input type="file" name="image">
            </div>

            <button class="" type="submit">Upload</button>
            {{--<button class="btn btn-block" type="submit">Upload</button>--}}

        </form>

        @isset ($path)
            <img src="{{ asset('/storage/' . $path) }}">
        @endisset

    </div>

@endsection