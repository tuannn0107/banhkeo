<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('New Permission')</h4>
                <form method="POST" action="{{route('permission.store')}}" class="floating-labels mt-2">
                    @csrf
                    <x-input name="name" label="Permission" required />
                    <x-toggle name="is_active" label="Status" class="mb-4" checked />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
