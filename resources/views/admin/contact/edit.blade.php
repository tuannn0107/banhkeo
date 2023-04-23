<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('Edit Contact')</h4>
                <form method="POST" action="{{route('contact.update', $contact->id)}}" class="floating-labels mt-4">
                    @csrf
                    @method('PUT')
                    <x-input name="name" :value="$contact->name" label="Name" />
                    <x-input name="phone" :value="$contact->phone" label="Phone number" />
                    <x-input name="email" :value="$contact->email" type="email" label="E-Mail Address" />
                    <x-input name="address" :value="$contact->address" label="Address" />
                    <x-textarea name="content" :value="$contact->content" label="Description" />
                    <x-button />
                </form>
            </div>
        </div>
    </div>
</div>
