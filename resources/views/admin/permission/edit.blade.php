<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('Edit Permission')</h4>
                <form method="POST" action="{{route('permission.update', $permission->id)}}" class="floating-labels mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$permission->id}}">
                    <x-input name="name" value="{{$permission->name}}" label="Permission" required />
                    <x-toggle name="is_active" label="Status" class="mb-4" checked="{{$permission->is_active}}" />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
