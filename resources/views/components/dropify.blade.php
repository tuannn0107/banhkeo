<div class="form-group {{$class}}">
    <input type="file" class="form-control js-dropify" name="{{$name}}" accept="image/*"
           @isset($value) data-default-file="{{$value}}" @endif data-show-remove="false"
           @if($required) required @endif @if($multiple) multiple @endif />
</div>
