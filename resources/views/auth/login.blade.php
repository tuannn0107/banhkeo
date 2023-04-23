@extends('auth.layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
        <div class="auth-box p-4 bg-white rounded">
            <div>
                <div class="logo">
                    <h3 class="box-title mb-3">@lang('Login')</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form method="POST" class="form-horizontal mt-3 form-material" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="">
                                    <input type="email" name="email" class="form-control"
                                           value="{{ old('email') }}" placeholder="@lang('E-Mail Address')" autocomplete="email" autofocus required>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="">
                                    <input type="password" name="password" class="form-control @error('email') is-invalid @enderror"
                                           autocomplete="password" placeholder="@lang('Password')" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex">
                                    <div class="checkbox checkbox-info pt-0">
                                        <input id="checkbox-signup" type="checkbox" name="remember" class="material-inputs chk-col-indigo" @checked(old('remember'))>
                                        <label for="checkbox-signup"> @lang('Remember Me') </label>
                                    </div>
                                    @if ($config->enable_forgotten_password)
                                    <div class="ml-auto">
                                        <a href="{{ route('password.request') }}" class="text-muted float-right"><i class="fa fa-lock mr-1"></i> @lang('Forgot Your Password?')</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-center mt-4">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">@lang('Login')</button>
                                </div>
                            </div>
                            @if ($config->enable_social_logins)
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                                    <div class="social mb-3">
                                        <a href="/facebook/login" class="btn btn-facebook" data-toggle="tooltip" title="@lang('Login with Facebook')"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </a>
                                        <a href="/google/login" class="btn btn-googleplus" data-toggle="tooltip" title="@lang('Login with Google')"> <i aria-hidden="true" class="fab fa-google-plus"></i> </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($config->enable_registration)
                            <div class="form-group mb-0 mt-4">
                                <div class="col-sm-12 justify-content-center d-flex">
                                    <p>@lang('New member?') <a href="{{ route('register') }}" class="text-info font-weight-normal ml-1">@lang('Register')</a> @lang('here')</p>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
