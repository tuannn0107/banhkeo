@extends('admin.layouts.app')

@section('title', __('Permission'))

@section('content')
    <div class="row">
        <div class="col-md-5">
            @includeWhen(isset($permission), 'admin.permission.edit')
            @includeWhen(!isset($permission), 'admin.permission.create')
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('All Permissions')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Permission')</th>
                                <th>@lang('Status')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($permissionList as $permission)
                            <tr>
                                <td>{{$permission->id}}</td>
                                <td><x-badge class="mb-1" :label="$permission->name" /></td>
                                <td><x-badge class="mb-1 {{$permission->active_class}}" :label="$permission->active_label" /></td>
                                <td><x-action route="permission" id="{{$permission->id}}" /></td>
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
