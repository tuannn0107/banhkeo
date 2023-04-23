@extends('auth.layouts.app')

@section('title', __('Reset Password'))

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
        <div class="auth-box p-4 bg-white rounded">
            <div id="forgot-password">
                <div class="logo">
                    <h3 class="font-weight-medium mb-3">@lang('Reset Password')</h3>
                    <span class="text-muted">@lang('Please enter the email that you want to reset the password.')</span>
                </div>
                <div class="row mt-3 form-material">
                    @if (session('status'))
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @else
                        <form method="POST" class="col-12" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"
                                           placeholder="@lang('E-Mail Address')" autocomplete="email" required autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-info text-uppercase" type="submit" name="action">@lang('Send Password Reset Link')</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="form-group mb-0 mt-4">
                    <div class="col-sm-12 justify-content-center d-flex">
                        <p><a href="{{ route('login') }}" class="text-info font-weight-normal ml-1"><i class="fa fa-arrow-left mr-1"></i> @lang('Back')</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
