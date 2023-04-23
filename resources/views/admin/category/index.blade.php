@extends('admin.layouts.app')

@section('title', __(Master::from($master)->category()->label()))

@section('content')
    <div class="row">
        <div class="col-md-5">
            @includeWhen(isset($category), 'admin.category.edit')
            @includeWhen(!isset($category), 'admin.category.create')
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{Master::from($master)->category()->allLabel()}}</h4>
                    <div class="myadmin-dd-empty dd js-nestable">
                        <ol class="dd-list">
                            @forelse($childCategoryList as $category)
                                @include('admin.category.show', $category)
                            @empty
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="/js/admin/jquery.nestable.js"></script>
    <script>
        $(function () {
            let updateCategoryList = function (e) {
                let $categoryList = e.length ? e : $(e.target);
                let formData = new FormData();
                formData.append('_token', '{{csrf_token()}}');
                formData.append('master_id', '{{$masterCategory->id}}');
                formData.append('categoryList', JSON.stringify($categoryList.nestable('serialize')));
                fetch('/admin/category/order', {method: 'POST', body: formData})
                    .then(response => response.text())
                    .then(data => {
                        toastr.info(data, $('meta[name=title]').attr("content"), {timeOut: 2000});
                    });
            };

            $('.js-nestable').nestable({group: 1}).on('change', updateCategoryList);
        });
    </script>
@endpush
