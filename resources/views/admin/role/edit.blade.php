<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('Edit Role')</h4>
                <form method="POST" action="{{route('role.update', $role->id)}}" class="floating-labels mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$role->id}}">
                    <x-input name="name" value="{{$role->name}}" label="Role" required />
                    <x-toggle name="is_active" label="Status" class="mb-4" checked="{{$role->is_active}}" />
                    <x-checkbox name="permissionList[]" :value="$role->permissionList->pluck('id')" :option-list="$permissionList" cols="2" class="mb-4" />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
