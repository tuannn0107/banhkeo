<div class="card">
    <div class="card-body">
        <h4 class="card-title">@lang('New')</h4>
        <form method="POST" action="{{route('category.store')}}" class="floating-labels mt-2" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" value="{{$masterCategory->id}}">
            <input type="hidden" name="type" value="{{$masterCategory->slug}}">
            <x-dropify name="file" required />
            <x-input name="name" label="Name" required />
            <x-textarea name="content" label="Content" rows="7" maxlength="1000" required count-character />
            <x-button/>
        </form>
    </div>
</div>
