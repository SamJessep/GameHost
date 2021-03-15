<div 
  {{ $attributes->merge(['class' => 'inline-flex px-6 py-2']) }}
  {{ $attributes }}>
  {{-- <span id="audioValue">100%</span> --}}
  <input 
    type="range" 
    min="0" 
    max="100" 
    value="100"
    class="my-auto disabled:cursor-not-allowed"
    id="audioSlider">
    <x-icons.unmute class="player-btn" id="mute-btn"></x-icons.unmute>
    <x-icons.mute class="player-btn hidden" id="unmute-btn"></x-icons.mute>
</div>