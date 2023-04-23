<form action="{{ route($route . '.destroy', $id) }}" method="POST">
    @if($enabledShow)
        <a href="{{ route($route . '.show', $id) }}" class="text-inverse pr-2" data-toggle="tooltip" title="@lang('View')">
            <i class="ti-eye"></i>
        </a>
    @endif

    @if($enabledEdit)
        <a href="{{ route($route . '.edit', $id) }}" class="text-inverse pr-2" data-toggle="tooltip" title="@lang('Edit')">
            <i class="ti-marker-alt"></i>
        </a>
    @endif

    @if($enabledDelete)
        @csrf
        @method('DELETE')
        <button type="submit" class="btn p-0 text-inverse js-delete-sweetalert" data-toggle="tooltip" title="@lang('Delete')">
            <i class="ti-trash"></i>
        </button>
    @endif
</form>
