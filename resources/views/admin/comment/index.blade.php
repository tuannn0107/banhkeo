@extends('admin.layouts.app')

@section('title', __('Comment'))

@section('content')
    <div class="row">
        <div class="col-md-5">
            @includeWhen(isset($comment), 'admin.comment.edit')
            @includeWhen(!isset($comment), 'admin.comment.create')
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('All Comment')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Name')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($commentList as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->name}}</td>
                                <td><x-action route="comment" id="{{$comment->id}}" /></td>
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
