<li class="dd-item dd3-item" data-id="{{$category->id}}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content">
        <span>{{$category->name}}</span>
        <span class="float-right"><x-action route="category" id="{{$category->id}}" /></span>
    </div>
    <ol class="dd-list">
    @foreach($category->childList as $category)
        @include('admin.category.show', $category)
    @endforeach
    </ol>
</li>
