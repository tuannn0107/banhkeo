<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('Edit Comment')</h4>
                <form method="POST" action="{{route('comment.update', $comment->id)}}" class="floating-labels mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$comment->id}}">
                    <x-input name="name" value="{{$comment->name}}" label="Name" required />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
