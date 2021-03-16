<div {{ $attributes->merge(['class' => 'flex']) }}>
  <div class="flex flex-col flex-grow">
    <input type="hidden" name="name" value="{{$fieldName}}">
    <div class="flex">
    <x-form.input class="h-{{$size ?? 8}} mt-3 mr-2" name="{{$fieldName}}" label="" labelClasses="flex-grow">
      <x-slot name="beforeWarning">
        <button type="submit" class="cursor-pointer focus:outline-none group">
          <x-icons.send class="w-{{$size ?? 8}} h-{{$size ?? 8}} transform rotate-90 text-gray-400 group-hover:text-green-500 my-auto mx-2"/>
        </button>
      </div>
      </x-slot>
    </x-form.input>  
  </div>
</div>