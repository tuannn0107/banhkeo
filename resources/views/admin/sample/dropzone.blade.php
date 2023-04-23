@extends('admin.layouts.app')

@section('title', __('Hình ảnh Sản Phẩm'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('Hình ảnh Sản Phẩm')</h4>
                    <form action="#" class="dropzone mb-5">
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
    </script>
@endpush
