<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{Master::from($master)->category()->newLabel()}}</h4>
        <form method="POST" action="{{route('category.store')}}" class="floating-labels mt-2" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="master_id" value="{{$masterCategory->id}}">
            <x-dropify name="file" />
            <x-input name="name" label="Category Name" required />
            <x-select name="category_id" label="Parent Category" :option-list="$descendantCategoryList" />
            <x-textarea name="content" label="Description" rows="3" />
            <x-button />
        </form>
    </div>
</div>
