<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('New Role')</h4>
                <form method="POST" action="{{route('role.store')}}" class="floating-labels mt-2">
                    @csrf
                    <x-input name="name" label="Role" required />
                    <x-toggle name="is_active" label="Status" class="mb-4" checked />
                    <x-checkbox name="permissionList[]" :option-list="$permissionList" cols="2" class="mb-4" />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
