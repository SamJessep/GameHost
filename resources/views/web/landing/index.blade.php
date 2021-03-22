@extends('web.layouts.app')

@section('title')
    Home
@endsection

@section('content')
  {{-- <h2 class="text-center text-2xl">Under Construction</h2> --}}
  <div class="flex md:w-4/5 w-full bg-red-500 mx-auto mt-5 p-3 flex-wrap justify-around">
    @foreach ($games as $game)
      <x-game.card :game="$game" :user="Auth::user()"/>
    @endforeach
  </div>
@endsection