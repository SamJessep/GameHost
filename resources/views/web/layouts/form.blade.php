@extends('web.layouts.app')

@section('content')
<div class="flex justify-center mt-5">
  <div class="md:w-4/5 w-full bg-white p-6 rounded-lg">
    @if (session('status'))
      <div class="bg-yellow-300 rounded-lg text-center text-lg p-3 text-yellow-800">
        {{session('status')}}
      </div>
    @endif
    <h2 class="text-xl text-center mb-4">@yield('title')</h2>
    @yield('form')
  </div>
</div>
@endsection