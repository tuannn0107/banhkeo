<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('New User')</h4>
                <form method="POST" action="{{route('user.store')}}" class="floating-labels mt-2">
                    @csrf
                    <x-input name="name" label="Name" required />
                    <x-input name="email" type="email" label="E-Mail Address" required />
                    <x-input name="password" type="password" label="Password" autocomplete="new-password" required />
                    <x-toggle name="is_active" label="Status" class="mb-4" checked />
                    <x-checkbox name="roleList[]" :option-list="$roleList" class="mb-4" />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
