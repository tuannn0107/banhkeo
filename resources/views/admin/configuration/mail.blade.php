@extends('admin.layouts.app')

@section('title', __('Mail'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Mail')</h4>
                    <form method="POST" action="{{route('configuration.store')}}" class="floating-labels mt-4">
                        @csrf
                        <x-input name="mail_transport" :value="$config->mail_transport" label="Mail Transport" required />
                        <x-input name="mail_host" :value="$config->mail_host" label="Mail Host" required />
                        <x-input name="mail_port" :value="$config->mail_port" label="Mail Port" required />
                        <x-input name="mail_encryption" :value="$config->mail_encryption" label="Mail Encryption" required />
                        <x-input name="mail_username" :value="$config->mail_username" label="Mail Username" required />
                        <x-input name="mail_password" :value="$config->mail_password" label="Mail Password" required />
                        <x-input name="mail_from_name" :value="$config->mail_from_name" label="Mail From Name" required />
                        <x-input name="mail_from_address" :value="$config->mail_from_address" label="Mail From Address" required />
                        <x-button />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
