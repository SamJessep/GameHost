@extends('web.layouts.app')

@section('title')
    Home
@endsection

@section('content')
  <div class="flex md:w-4/5 w-full bg-white rounded mx-auto mt-5 p-3 flex-wrap justify-around">
    @foreach ($games as $game)
      <x-game.card :game="$game" :user="Auth::user()"/>
    @endforeach
  </div>
@endsection