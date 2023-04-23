@extends('auth.layouts.app')

@section('title', __('Sign up'))

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
        <div class="auth-box p-4 bg-white rounded">
            <div>
                <div class="logo">
                    <h3 class="box-title mb-3">@lang('Sign up')</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form method="POST" class="form-horizontal mt-3 form-material" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" placeholder="@lang('Name')" autocomplete="name" autofocus required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <div class="col-xs-12">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" placeholder="@lang('E-Mail Address')" autocomplete="email" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                           placeholder="@lang('Password')" autocomplete="new-password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="@lang('Confirm Password')" autocomplete="new-password" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="">
                                    <div class="checkbox checkbox-success pt-0">
                                        <input id="checkbox-signup" type="checkbox" name="terms" class="chk-col-indigo material-inputs @error('terms') is-invalid @enderror">
                                        <label for="checkbox-signup"> @lang('I agree to all') <a href="#">@lang('Terms of Use')</a></label>
                                        @error('terms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center mb-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">@lang('Sign up')</button>
                                </div>
                            </div>
                            <div class="form-group mb-0 mt-2 ">
                                <div class="col-sm-12 text-center ">
                                    @lang('Have an account?') <a href="{{route('login')}}" class="text-info ml-1">@lang('Login')</a> @lang('here')
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
