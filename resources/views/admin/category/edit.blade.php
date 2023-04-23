<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{Master::from($master)->category()->editLabel()}}</h4>
        <form method="POST" action="{{route('category.update', $category->id)}}" class="floating-labels mt-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$category->id}}">
            <input type="hidden" name="master_id" value="{{$masterCategory->id}}">
            <x-dropify name="file" value="{{$category->image}}" />
            <x-input name="name" value="{{$category->name}}" label="Category Name" required />
            <x-select name="category_id" value="{{$category->category_id}}" label="Parent Category" :option-list="$descendantCategoryList" />
            <x-textarea name="content" value="{{$category->content}}" label="Description" rows="3" />
            <x-button />
        </form>
    </div>
</div>
