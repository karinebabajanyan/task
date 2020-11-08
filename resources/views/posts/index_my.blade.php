@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($posts as $key=>$post)
                <div class="col-md-10 blogShort">
                    <h1>{{$post->title}}</h1>
                    <h6>{{$post->users->name}}</h6>
                    <img src="{{$post->image_path}}" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail" width="100">
                    <article><p>
                            {{$post->description}}
                        </p></article>
                </div>
            @endforeach
        </div>
    </div>
@endsection
