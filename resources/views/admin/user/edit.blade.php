<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('Edit User')</h4>
                <form method="POST" action="{{route('user.update', $user->id)}}" class="floating-labels mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <x-input name="name" value="{{$user->name}}" label="Name" required />
                    <x-input name="email" value="{{$user->email}}" type="email" label="E-Mail Address" required />
                    <x-input name="password" type="password" label="Password" autocomplete="new-password" />
                    <x-toggle name="is_active" label="Status" class="mb-4" checked="{{$user->is_active}}" />
                    <x-checkbox name="roleList[]" :value="$user->roleList->pluck('id')" :option-list="$roleList" class="mb-4" />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
