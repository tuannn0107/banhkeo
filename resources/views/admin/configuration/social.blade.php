@extends('admin.layouts.app')

@section('title', __('Social Network'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Social Network')</h4>
                    <form method="POST" action="{{route('configuration.store')}}" class="floating-labels mt-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-input name="facebook" :value="$config->facebook" label="Facebook"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="instagram" :value="$config->instagram" label="Instagram"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="twitter" :value="$config->twitter" label="Twitter"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="tumblr" :value="$config->tumblr" label="Tumblr"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="pinterest" :value="$config->pinterest" label="Pinterest"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="linkedin" :value="$config->linkedin" label="LinkedIn"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="flickr" :value="$config->flickr" label="Flickr"/>
                            </div>
                            <div class="col-md-6">
                                <x-input name="youtube" :value="$config->youtube" label="Youtube"/>
                            </div>
                        </div>
                        <x-button/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
