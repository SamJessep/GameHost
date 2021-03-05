@extends('web.layouts.app')

@section('content')
<div class="flex justify-center mt-5">
  <div class="w-4/12 bg-white p-6 rounded-lg">
    @if (session('status'))
      <div class="bg-red-300 rounded-lg text-center text-lg p-3 text-red-800">
        {{session('status')}}
      </div>
    @endif
    @yield('form')
  </div>
</div>
@endsection