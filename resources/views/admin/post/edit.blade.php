@extends('admin.layouts.app')

@section('title', Master::from($master)->editLabel())

@section('content')
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{route('post.update', $post->id)}}" class="floating-labels mt-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$post->id}}">
                <input type="hidden" name="master" value="{{$master}}">
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <x-dropify name="file" value="{{$post->image}}" />
                                        @can('viewAny', App\Models\Category::class)
                                            <x-select name="category_id" value="{{$post->category->value('id')}}" label="Category" :option-list="$categoryList" required />
                                        @endcan
                                        @if ('product' == $master)
                                            <x-input type="number" name="price" value="{{$post->price}}" label="Price" />
                                            <x-input type="number" name="sale_price" value="{{$post->sale_price}}" label="Sale Price" />
                                            <x-checkbox name="productTypeList[]" :value="$currentProductTypeList" :option-list="$productTypeList" cols="1" class="mb-4" />
                                        @endif
                                        <x-input name="published_at" value="{{$post->time}}" label="Published On" />
                                        <x-toggle name="is_active" label="Visibility" class="mb-0" checked="{{$post->is_active}}" />
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
                                <x-input name="name" value="{{$post->name}}" label="Title" class="mt-4 mb-5" required />
                                <x-textarea name="excerpt" value="{{$post->excerpt}}" label="Excerpt" class="no" rows="3" />
                                <x-summernote name="content" value="{{$post->content}}" label="Content" />
                                @editSeo
                                <x-button />
                                <x-button name="back" label="Save and Back" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @forelse($post->imageList as $image)
            <form id="js-image-{{$image->id}}" action="{{route('image.destroy', $image->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
            @empty
            @endforelse
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
