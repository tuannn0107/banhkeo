<div class="form-group {{$class}} @error($name) has-error @enderror">
    <textarea id="{{$name}}" type="{{$type}}" name="{{$name}}" rows="{{$rows}}" maxlength="{{$maxlength}}"
              class="form-control {{$inputClass}} @error($name) is-invalid @enderror
              @if($countCharacter) js-character-input @endif" @if($required) required @endif
              @if($autocomplete) autocomplete="{{$autocomplete}}" @endif>{!! old($name, $value) !!}</textarea>
    <span class="bar"></span>
    <label for="{{$name}}">@lang($label) @if($required)<code>*</code>@endif @if($hint)<small>({{$hint}})</small>@endif</label>
    <span class="help-block d-none @if($countCharacter) d-block @endif"><small class="js-character-label"></small><small> / {{$maxlength}}</small></span>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
