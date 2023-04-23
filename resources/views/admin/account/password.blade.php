@extends('admin.layouts.app')

@section('title', __('Change Password'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Change Password')</h4>
                    <form method="POST" action="{{route('change-password.update', $id)}}" class="floating-labels mt-4">
                        @csrf
                        @method('PUT')
                        <x-input name="current_password" type="password" label="Current password" required />
                        <x-input name="new_password" type="password" label="New password" required autocomplete="password" />
                        <x-input name="new_password_confirmation" type="password" label="Confirm new password" required />
                        <x-button />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
