<label>{{$label}}
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
@error($name)
<div class="text-red-500">{{$message}}</div>
@enderror