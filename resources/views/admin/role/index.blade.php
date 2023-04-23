@extends('admin.layouts.app')

@section('title', __('Role'))

@section('content')
    <div class="row">
        <div class="col-md-5">
            @includeWhen(isset($role), 'admin.role.edit')
            @includeWhen(!isset($role), 'admin.role.create')
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('All Roles')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Role')</th>
                                <th>@lang('Permission')</th>
                                <th>@lang('Status')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($roleList as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td><x-badge class="mb-1" :label="$role->name" /></td>
                                <td>
                                    @forelse($role->permissionList as $permission)
                                        <x-badge class="mb-1" :label="$permission->name" />
                                    @empty
                                    @endforelse
                                </td>
                                <td><x-badge class="mb-1 {{$role->active_class}}" :label="$role->active_label" /></td>
                                <td><x-action route="role" id="{{$role->id}}" /></td>
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
