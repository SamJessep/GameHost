<div   
  {{ $attributes->merge(['class' => 'border-b-4 hover:border-green-500']) }}
  {{ $attributes }}
  >
  {{$slot}}
</div>