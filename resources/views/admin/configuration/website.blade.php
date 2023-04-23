@extends('admin.layouts.app')

@section('title', __('Website'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Website')</h4>
                    <form method="POST" action="{{route('configuration.store')}}" class="floating-labels mt-4" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <x-upload name="sitemap" label="Upload" class="mb-3" hint="sitemap.xml" accept="text/xml" auto-submit/>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <x-upload name="logo" label="Upload" class="mb-3" hint="logo.png" accept="image/*" auto-submit/>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <x-upload name="favicon" label="Upload" hint="favicon.png" accept="image/*" auto-submit/>
                            </div>
                        </div>
                        @if ($config->enable_multiple_languages)
                            <x-select name="locale" :value="$config->locale" label="Language" :option-list="$languageList"/>
                        @endif
                        <x-input name="title" :value="$config->title" label="Title"/>
                        <x-textarea name="description" :value="$config->description" label="Description"/>
                        <div class="row">
                            <div class="col-md-6">
                                <x-textarea name="css" rows="7" :value="$config->css" label="Style" maxlength="2000"/>
                            </div>
                            <div class="col-md-6">
                                <x-textarea name="js" rows="7" :value="$config->js" label="Script" maxlength="2000"/>
                            </div>
                        </div>
                        <x-button/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
