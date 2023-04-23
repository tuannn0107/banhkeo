@extends('admin.layouts.app')

@section('title', __('My Profile'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('profile.update', $user->id)}}" class="floating-labels mt-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                <x-dropify name="file" value="{{$user->image}}" class="mb-5 mb-lg-3" />
                            </div>
                            <div class="col-lg-8 col-xl-9">
                                <x-input name="name" value="{{$user->name}}" label="Name" required />
                                <x-input name="email" value="{{$user->email}}" type="email" label="E-Mail Address" required />
                                <x-button />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
