@extends('auth.layouts.app')

@section('title', __('Confirm Password'))

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
        <div class="auth-box p-4 bg-white rounded">
            <div id="confirm-password">
                <div class="logo">
                    <h3 class="font-weight-medium mb-3">@lang('Confirm Password')</h3>
                    <span class="text-muted">@lang('Please confirm your password before continuing.')</span>
                </div>
                <div class="row mt-3 form-material">
                    <form method="POST" class="col-12" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       placeholder="@lang('Password')" autocomplete="current-password" required autofocus>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- pwd -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-block btn-lg btn-info text-uppercase" type="submit">@lang('Confirm Password')</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if ($config->enable_forgotten_password)
                <div class="form-group mb-0 mt-4">
                    <div class="col-sm-12 justify-content-center d-flex">
                        <p><a href="{{ route('password.request') }}" class="text-info font-weight-normal ml-1"><i class="fa fa-lock mr-1"></i> @lang('Forgot Your Password?')</a></p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
