@extends('auth.layouts.app')

@section('title', __('Verify Your Email Address'))

@section('content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
    <div class="auth-box p-4 bg-white rounded">
        <div>
            <div class="logo">
                <h3 class="font-weight-medium mb-3">@lang('Verify Your Email Address')</h3>
            </div>
            <div class="row mt-3 form-material">
                @if (session('resent'))
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        @lang('A fresh verification link has been sent to your email address.')
                    </div>
                </div>
                @else
                <div class="col-12">
                    <span class="text-muted">@lang('Before proceeding, please check your email for a verification link.')</span>
                    <span class="text-muted">@lang('If you did not receive the email'),</span>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-info p-0 m-0 align-baseline">@lang('click here to request another')</button>.
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
