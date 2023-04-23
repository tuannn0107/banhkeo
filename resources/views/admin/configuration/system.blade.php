@extends('admin.layouts.app')

@section('title', __('Setting'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Setting')</h4>
                    <form method="POST" action="{{route('configuration.system')}}" class="floating-labels mt-4">
                        @csrf
                        @foreach(App\Enums\SystemType::cases() as $systemType)
                            <x-toggle :name="$systemType->value" class="mb-4" :label="$systemType->label()" :checked="$config->{$systemType->value}"/>
                        @endforeach
                        <x-button/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
