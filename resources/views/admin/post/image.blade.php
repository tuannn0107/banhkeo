<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <x-dropify name="fileList[]" multiple class="no" />
            </div>
        </div>
        @isset($post)
        <div class="row el-element-overlay draggable-cards js-dragula">
            @forelse($post->imageList as $image)
                <div class="col-md-3 col-lg-6 p-1 js-order" id="{{$image->id}}">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 w-100 overflow-hidden position-relative text-center">
                            <img @src="{{$image->image}}" class="d-block position-relative w-100" alt="{{$post->name}}" />
                            <div class="el-overlay w-100 overflow-hidden">
                                <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
                                    <li class="el-item d-inline-block my-0 mx-1">
                                        <a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white"
                                           href="{{$image->image}}"><i class="icon-magnifier"></i></a></li>
                                    <li class="el-item d-inline-block my-0 mx-1">
                                        <a class="btn default btn-outline el-link text-white border-white" href="javascript:void(0);"
                                           onclick="event.preventDefault(); document.getElementById('js-image-{{$image->id}}').submit();">
                                            <i class="icon-close"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        @endisset
    </div>
</div>

@push('js')
    <script>
        $(function () {
            dragula([document.querySelector(".js-dragula")]).on("out", function (e, t) {
                t.className = t.className.replace("card-over", "");
                let formData = new FormData();
                formData.append('_token', '{{csrf_token()}}');
                $('.js-order').each(function (index) {
                    formData.append($(this).attr('id'), index);
                });

                fetch('/admin/image/order', {method: 'POST', body: formData})
                    .then(response => response.text())
                    .then(data => {
                        toastr.info(data, $('meta[name=title]').attr("content"), {timeOut: 2000});
                    });
            })
        });
    </script>
@endpush
