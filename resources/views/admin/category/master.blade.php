@extends('admin.layouts.app')

@section('title', __('Master Category'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Master Category')</h4>
                    <form method="POST" action="{{route('category.master')}}" class="floating-labels mt-4">
                        @csrf
                        <input type="hidden" name="master" value="master">
                        @forelse($masterCategoryList as $masterCategory)
                        <x-toggle :name="$masterCategory->id" :value="$masterCategory->id" class="mb-4"
                                  :label="$masterCategory->name" :checked="$masterCategory->is_active" />
                        @empty
                        @endforelse
                        <x-button/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
