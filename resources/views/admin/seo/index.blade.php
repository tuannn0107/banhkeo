@extends('admin.layouts.app')

@section('title', __('Seo'))

@section('content')
    @isset($seo)
    @php($isShow = true)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('seo.update', $seo->id)}}" class="floating-labels mt-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @editSeo
                        <x-button />
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endisset
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('All Seos')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Title')</th>
                                <th>@lang('Link')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($seoList as $seo)
                            <tr>
                                <td>{{$seo->id}}</td>
                                <td>{{$seo->title}}</td>
                                <td>{{$seo->canonical}}</td>
                                <td><x-action route="seo" id="{{$seo->id}}" /></td>
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
