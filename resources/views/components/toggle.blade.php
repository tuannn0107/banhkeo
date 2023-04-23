<div class="form-group {{$class}}">
    <div class="switch">
        <label>
            <input id="{{$name}}" type="checkbox" name="{{$name}}" class="form-control {{$inputClass}}" @checked($checked)>
            @lang($label)
            <span class="lever"></span>
        </label>
    </div>
</div>
