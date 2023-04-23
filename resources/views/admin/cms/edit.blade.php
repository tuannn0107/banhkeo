<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('Edit CMS')</h4>
                <form method="POST" action="{{route('cms.update', $configuration->id)}}" class="floating-labels mt-4"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if(str($configuration->content)->startsWith(config('constants.folder.upload')))
                        <x-dropify name="file" class="mb-4" value="{{$configuration->content}}" />
                    @else
                        <x-textarea name="content" value="{{$configuration->content}}" label="Content" rows="5" />
                    @endif
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
