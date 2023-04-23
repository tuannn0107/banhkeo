@extends('admin.layouts.app')

@section('title', __('Contact'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Contact')</h4>
                    <form method="POST" action="{{route('configuration.store')}}" class="floating-labels mt-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-input name="phone" :value="$config->phone" label="Phone Number"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="phone_2" :value="$config->phone_2" label="Phone Number" hint="2"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="email" :value="$config->email" type="email" label="E-Mail Address" required/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="email_2" :value="$config->email_2" type="email" label="E-Mail Address" hint="2"/>
                            </div>
                        </div>
                        <x-textarea name="address" :value="$config->address" label="Address"/>
                        <div class="row">
                            <div class="col-md-6">
                                <x-input name="whatsapp" :value="$config->whatsapp" label="WhatsApp"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="zalo" :value="$config->zalo" label="Zalo"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="messenger" :value="$config->messenger" label="Messenger"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="map" :value="$config->map" label="Map"/>
                            </div>
                        </div>
                        <x-button/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
