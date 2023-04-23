<textarea name="{{$name}}" placeholder="@lang($label) @if($required) * @endif"
          class="js-summernote form-material">{!! old($name, $value) !!}</textarea>
