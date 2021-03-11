<div   
  {{ $attributes->merge(['class' => 'border-b-4 hover:border-green-500 cursor-pointer']) }}
  {{ $attributes }}
  >
  {{$slot}}
</div>