@extends('admin.layouts.app')

@section('title', __('Testimony'))

@section('content')
    <div class="row">
        <div class="col-md-5">
            @includeWhen(isset($category), 'admin.testimony.edit')
            @includeWhen(!isset($category), 'admin.testimony.create')
        </div>
        <div class="col-md-7">
            <div class="row draggable-cards js-dragula">
                @forelse($childCategoryList as $category)
                    <div class="col-12 js-order" id="{{$category->id}}">
                        <div class="card mb-1">
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-sm-3 mb-2 mb-sm-0">
                                        <a href="{{$category->slug_corrected}}" target="_blank"><img @src="{{$category->image}}" width="80"></a>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-12">{{$category->name_corrected}}</div>
                                            <div class="col-12">{{$category->excerpt}}</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 d-flex flex-column justify-content-center align-items-center">
                                        <x-action route="category" id="{{$category->id}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .dropify-wrapper {
            height: 150px;
        }

        #content {
            resize: none;
        }
    </style>
@endpush

@push('js')
    <script>
        $(function () {
            dragula([document.querySelector(".js-dragula")]).on("out", function (e, t) {
                t.className = t.className.replace("card-over", "");
                let formData = new FormData();
                formData.append('_token', '{{csrf_token()}}');
                formData.append('master_id', '{{$masterCategory->id}}');
                let categoryList = [];
                $('.js-order').each(function () {
                    categoryList.push({'id': $(this).attr('id'), 'children': []});
                });
                formData.append('categoryList', JSON.stringify(categoryList));
                fetch('/admin/category/order', {method: 'POST', body: formData})
                    .then(response => response.text())
                    .then(data => {
                        toastr.info(data, $('meta[name=title]').attr("content"), {timeOut: 2000});
                    });
            })
        });
    </script>
@endpush
