<div class="card">
    <div class="card-body">
        <h4 class="card-title">@lang('Edit')</h4>
        <form method="POST" action="{{route('category.update', $category->id)}}" class="floating-labels mt-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$category->id}}">
            <input type="hidden" name="category_id" value="{{$masterCategory->id}}">
            <input type="hidden" name="master" value="{{$masterCategory->slug}}">
            <x-dropify name="file" :value="$category->image"/>
            <x-input name="name" :value="$category->name_corrected" label="Title" />
            <x-input name="slug" :value="$category->slug_corrected" label="Link"/>
            <x-textarea name="content" :value="$category->content" label="Content" rows="3" count-character/>
            <x-button/>
        </form>
    </div>
</div>
