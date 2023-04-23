@extends('admin.layouts.app')

@section('title', __('Content Management System'))

@section('content')
    <div class="row">
        <div class="col-md-5">
            @includeWhen(isset($configuration), 'admin.cms.edit')
            @includeWhen(!isset($configuration), 'admin.cms.create')
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('Content Management System')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Content')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($cmsList as $cms)
                            <tr>
                                <td>{{$cms->id}}</td>
                                <td>
                                    @if(str($cms->content)->startsWith(config('constants.folder.upload')))
                                        <img @src="{{$cms->content}}" width="80">
                                    @else
                                        {{$cms->excerpt}}
                                    @endif
                                </td>
                                <td><x-action route="cms" id="{{$cms->id}}" /></td>
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
