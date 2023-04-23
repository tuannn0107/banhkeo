@extends('admin.layouts.app')

@section('title', Master::from($masterCategory->slug)->allLabel())

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-lg-right mb-3">
                        @foreach($statusList as $status)
                            <a class="btn btn-sm {{$status->type == $statusType ? 'btn-success disabled' : 'btn-outline-success'}} mr-1 mb-1"
                               href="{{ route('post.index', ['master' => $masterCategory->slug, 'status' => $status->type]) }}">
                                <i class="fa {{$status->class}}"></i> @lang($status->name)</a>
                        @endforeach
                    </div>
                    <h4 class="card-title mb-4">{{Master::from($masterCategory->slug)->allLabel()}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                @can('viewAny', App\Models\Category::class)<th>@lang('Category')</th>@endcan
                                <th>@lang('Title')</th>
                                @if('product' == $masterCategory->slug)<th>@lang('Price')</th>@endif
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($postList as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td><a href="{{href($masterCategory->slug, $post->slug)}}" target="_blank"><img @src="{{$post->image}}" width="80" /></a></td>
                                    @can('viewAny', App\Models\Category::class)<td>{{$post->category->first()?->name}}</td>@endcan
                                    <td>{{$post->name}}</td>
                                    @if('product' == $masterCategory->slug)<td>{!!$post->price_label!!}</td>@endif
                                    <td><x-action route="post" id="{{$post->id}}" /></td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
