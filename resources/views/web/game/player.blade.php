@extends('web.layouts.app')

@section('title')
    {{$game->name}}
@endsection

@section('content')
  <div class="bg-green-500 max-h-screen h-screen mx-24">
    <iframe 
      id="game-window"
      src="{{route('cloud',['target'=>$game->gameUrl])}}/index.html" 
      class="mt-5 m-auto h-3/5 w-full px-2"
    >
    </iframe>
    <div id="controlBar" class="bg-blue-500">
      <x-game.audioSlider></x-game.audioSlider>
      <x-icons.fullscreen class="w-8 h-8 inline"></x-icons.fullscreen>
    </div>
    <div>
      <h1 class="text-xl">{{$game->name}}</h1>
      <x-game.author :author="$game->authorUser()" />
        <div class="flex p-4">
          @foreach (explode("; ",$game->gallaryImages) as $imgUrl)
          <div class="w-8/12 h-8/12">
            <img src="{{env('GAME_STORE_URL').$imgUrl}}" alt="{{$game->name."'s gallary image"}}">
          </div>
          @endforeach
        </div>
        <p>{{$game->description}}</p>
      </div>
    </div>
@endsection


@section('footer-scripts')
  @parent
  @include('scripts.audio-slider')  
@endsection