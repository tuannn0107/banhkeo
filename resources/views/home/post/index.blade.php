@extends('home.layouts.app')

@section('title', $category->name)

@section('h2', $category->name)

@section('content')
    <!--box-->
    <div class="width100">
        <div class="col-lg-12">
            <h1 class="heading-home">{{isset($seo) ? $seo->title : $category->name}}</h1>
            <div class="des-home" style="text-align: left;">{!! isset($page) ? $page->content : $category->content !!}</div>
        </div>
        <div class="boxContent">
            @forelse($postList as $data)
                <div class="col-md-12">
                    <div class="news_small">
                        <div class="img">
                            <a title="{{$data->name}}" href="{{$data->href}}">
                                <img alt="{{$data->name}}" src="{{$data->image}}"/>
                            </a>
                        </div>
                        <div class="info">
                            <a title="{{$data->name}}" href="{{$data->href}}">
                                <h3 class="title">{{$data->name}}</h3>
                            </a>
                            <div class="des">
                                {{$data->excerpt}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="pages"></div>
        </div>
    </div>
    <!--End Box-->
@endsection
