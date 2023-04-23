@extends('admin.layouts.app')

@section('title', __('User'))

@section('content')
    <div class="row">
        <div class="col-md-5">
            @includeWhen(isset($user), 'admin.user.edit')
            @includeWhen(!isset($user), 'admin.user.create')
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('All Users')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Name')</th>
                                <th>@lang('Role')</th>
                                <th>@lang('Status')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($userList as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><a href="mailto:{{$user->email}}">{{$user->name}}</a></td>
                                <td>
                                    @forelse($user->roleList as $role)
                                        <x-badge class="mb-1" :label="$role->name" />
                                    @empty
                                    @endforelse
                                </td>
                                <td><x-badge class="mb-1 {{$user->active_class}}" :label="$user->active_label" /></td>
                                <td><x-action route="user" id="{{$user->id}}" /></td>
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
