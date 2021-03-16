<label class="{{$labelClasses??""}}">{{$label}}
  {{ $slot }}
  <input 
  name="{{$name}}"
  {{ $attributes->merge(['class' => 'form-field']) }}
  {{ $attributes }} 
  @if (!$attributes->has('dontRemember')) 
  value="{{old($name)}}" 
  @endif 
  >
</label>
{{$beforeWarning}}
@error($name)
<div class="text-red-500">{{$message}}</div>
@enderror