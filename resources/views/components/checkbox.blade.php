<div class="row {{$class}}">
    @forelse($optionList as $option)
        <div class="col-lg-{{intval(12/$cols)}} mb-4">
            <input type="checkbox" name="{{$name}}" id="option_{{$loop->index}}" value="{{$option->id}}"
                   class="material-inputs" @checked(collect(old(Str::remove('[]', $name), $value))->contains($option->id)) />
            <label for="option_{{$loop->index}}">@lang($option->name)</label>
        </div>
    @empty
    @endforelse
</div>
