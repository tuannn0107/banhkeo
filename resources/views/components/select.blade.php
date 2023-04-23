<div class="form-group {{$class}} @error($name) has-error @enderror">
    <select id="{{$name}}" name="{{$name}}" @if($required) required @endif class="form-control p-0 {{$inputClass}} @error($name) is-invalid @enderror">
        <option></option>
        @forelse($optionList as $option)
            <option value="{{$option->id}}" @selected($option->id == (old($name, $value)))>{{$option->name}}</option>
        @empty
        @endforelse
    </select>
    <span class="bar"></span>
    <label for="{{$name}}">@lang($label) @if($required)<code>*</code>@endif @if($hint)<small>({{$hint}})</small>@endif</label>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
