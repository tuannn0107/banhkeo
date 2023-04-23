@extends('home.layouts.app')

@section('title', $post->name)

@section('content')
    <div class="fulltext">
        {!! $post->content !!}
    </div>
@endsection
