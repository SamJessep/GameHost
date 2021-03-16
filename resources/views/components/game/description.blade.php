<div {{$attributes}}>
  <span class="{{$textClasses}}" >{{substr($text,0,200)}}</span>@if(strlen($text)>=200)<button id="showMoreBtn" class="inline mx-3 {{$btnClasses}}" >Show More</button><span id="rest" class="opacity-0 transition-all h-0 block overflow-hidden {{$textClasses}}">{{substr($text,200)}}</span>
    <button id="showLessBtn" class="hidden mx-3 {{$btnClasses}}" >Show Less</button>
  @endif()
</div>