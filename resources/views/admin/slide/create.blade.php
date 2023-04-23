<div class="card">
    <div class="card-body">
        <h4 class="card-title">@lang('New')</h4>
        <form method="POST" action="{{route('category.store')}}" class="floating-labels mt-2" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" value="{{$masterCategory->id}}">
            <input type="hidden" name="master" value="{{$masterCategory->slug}}">
            <x-dropify name="file" required/>
            <x-input name="name" label="Title" />
            <x-input name="slug" label="Link" />
            <x-textarea name="content" label="Content" rows="3" count-character />
            <x-button/>
        </form>
    </div>
</div>
