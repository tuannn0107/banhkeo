@extends('home.layouts.app')

@section('title', $post->name)

@section('h2', $post->name)

@section('child', $category->name)

@section('childSlug', $category->href)

@section('content')
    <h1 class="heading">{{isset($seo) ? $seo->title : $post->name}}</h1>

    <div class="news_ctn">
        {!! $post->content !!}

        <div class="clearfix" style="margin-top: 20px; padding-bottom: 10px; border-top: #ccc dotted 1px;"></div>

        <div class="other_news">
            <h2>Tin liên quan</h2>
            <ul>
                @forelse($postList as $data)
                    <li><a href="{{$data->href}}">{{$data->name}}</a></li>
                @empty
                @endforelse
            </ul>
        </div>
    </div>
@endsection
