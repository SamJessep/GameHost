@extends('web.layouts.app')

@section('title')
    {{$game->name}}
@endsection

@section('content')
<section class="bg-gray-700 sm:mx-24 p-4 mt-5">
  <div class="h-screen flex flex-col">
    <h1 class="text-3xl text-center text-green-400">{{$game->name}}</h1>
    <div class="mt-5 m-auto w-full pt-4 flex-grow h-96">
      <iframe 
      id="game-window"
      src="{{route('cloud',['target'=>$game->gameUrl])}}/index.html" 
      class="h-full w-full"
      >
      </iframe>
      <x-game.loading-game/>
    </div>
    <div id="controlBar" class="flex bg-gray-600 rounded mb-5">
      <x-game.audioSlider class="flex-grow"></x-game.audioSlider>
      <div class="px-6 py-2">
        <x-icons.fullscreen class="player-btn" id="fullscreen-btn"></x-icons.fullscreen>
      </div>
    </div>
  </div>
  <x-game.author :author="$game->authorUser()" class="mb-5"/>
  <div class="flex sm:flex-row flex-col">
    <div class="sm:w-7/12 mx-6">
      <x-game.description :text="$game->description" textClasses="text-white text-xl" btnClasses="link text-2xl" class="transition-all" />
      @livewire("comments-section",["game"=>$game])
        {{-- <x-game.comments-section :game="$game" /> --}}
    </div>
    <div class="sm:w-5/12 mx-6">
      @include('web.game.player.gallary-preview')
    </div>
  </div>
</section>
  
@endsection


@section('footer-scripts')
  @parent
  @include('scripts.lottie-player')
  @include('scripts.audio-slider')
  @include('scripts.fullscreen')
  @include('scripts.gallary-slider')
  @include('scripts.prevent-kb-scroll')
  @include('scripts.game-loader')
  @include('scripts.show-more')
  @include('scripts.comments')
  @livewireScripts
@endsection