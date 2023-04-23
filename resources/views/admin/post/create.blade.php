@extends('admin.layouts.app')

@section('title', Master::from($master)->newLabel())

@section('content')
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{route('post.store')}}" class="floating-labels mt-4" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <x-dropify name="file" required />
                                        @can('viewAny', App\Models\Category::class)
                                            <x-select name="category_id" label="Category" :option-list="$categoryList" required />
                                        @endcan
                                        @if ('product' == $master)
                                            <x-input type="number" name="price" label="Price" />
                                            <x-input type="number" name="sale_price" label="Sale Price" />
                                            <x-checkbox name="productTypeList[]" :option-list="$productTypeList" cols="1" class="mb-4" />
                                        @endif
                                        <x-input name="published_at" label="Published On" />
                                        <x-toggle name="is_active" label="Visibility" class="mb-0" checked />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                @includeWhen('product' == $master, 'admin.post.image')
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <x-input name="name" label="Title" class="mt-4 mb-5" required />
                                <x-textarea name="excerpt" label="Excerpt" class="no" rows="3" />
                                <x-summernote name="content" label="Content" />
                                @createSeo
                                <x-button />
                                <x-button name="new" label="Save and Add Another" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <link href="/css/admin/magnific-popup.css" rel="stylesheet">
@endpush

@push('js')
    <script src="/js/admin/jquery.magnific-popup.min.js"></script>
    <script src="/js/admin/meg.init.js"></script>
    <script>
        $('#published_at').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm'});
    </script>
@endpush
