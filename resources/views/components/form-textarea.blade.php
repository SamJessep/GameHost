<label>{{$label}}
  {{ $slot }}
  <textarea 
    name="{{$name}}"
    {{ $attributes->merge(['class' => 'form-field']) }}
    {{ $attributes }} 
    >@if (!$attributes->has('dontRemember')){{old($name) ?? $textAreaValue}}@endif</textarea>
  {{-- {{ $bottomSlot }} --}}
</label>
@error($name)
<div class="text-red-500">{{$message}}</div>
@enderror