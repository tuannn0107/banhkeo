<div class="input-group {{$class}}">
    <input id="{{$name}}" type="file" name="{{$name}}" class="custom-file-input"
           accept="{{$accept}}" @if($autoSubmit) onchange="form.submit()" @endif>
    <label for="{{$name}}" class="border-bottom w-100">
        <small>@lang($label)</small> <code>{{$hint}}</code>
    </label>
</div>
