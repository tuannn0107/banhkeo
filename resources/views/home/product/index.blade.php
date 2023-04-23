@extends('home.layouts.app')

@section('title', $category->name)

@section('h2', $category->name)

@section('content')
    <div class="width100">
        <h1 class="heading">{{isset($seo) ? $seo->title : $category->name}}</h1>

        <div class="list-style-buttons">
            <form method="GET" action="{{$category->href}}">
                <select class="sort-pro" style="margin-top: -15px;" name="sort" onchange="this.form.submit()">
                    @foreach(SortType::cases() as $sortType)
                        <option value={{$sortType->value}} @selected($sortType->value == request()->sort)>{{$sortType->label()}}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="des-home" style="text-align: left; margin-bottom: 20px; padding: 0;">
            {!! isset($page) ? $page->content : $category->content !!}
        </div>

        <div class="row" id="product">
            @forelse($postList as $data)
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-product" data-sort="69" data-title="{{$data->name}}">
                    @include('home.product.item')
                </div>
            @empty
            @endforelse
            <div class="clearfix"></div>
            <div class="pages"></div>
        </div>
    </div>
@endsection
