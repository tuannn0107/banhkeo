<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('New Comment')</h4>
                <form method="POST" action="{{route('comment.store')}}" class="floating-labels mt-2">
                    @csrf
                    <x-input name="name" label="Name" required />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
