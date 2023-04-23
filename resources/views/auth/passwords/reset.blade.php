@extends('auth.layouts.app')

@section('title', __('Reset Password'))

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
        <div class="auth-box p-4 bg-white rounded">
            <div id="reset-password">
                <div class="logo">
                    <h3 class="font-weight-medium mb-3">@lang('Reset Password')</h3>
                </div>
                <div class="row mt-3 form-material">
                    <form method="POST" class="col-12" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group row @error('email') has-danger @enderror">
                            <div class="col-12">
                                <input type="email" name="email" value="{{ $email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="@lang('E-Mail Address')" autocomplete="email" required autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       placeholder="@lang('Password')" autocomplete="new-password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="">
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="@lang('Confirm Password')" autocomplete="new-password" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-block btn-lg btn-info text-uppercase" type="submit" name="action">@lang('Save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
