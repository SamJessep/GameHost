@extends('web.layouts.app')

@section('content')
<div class="p-20">
@yield('error-body')
<p class="text-lg text-center mt-5">Click <a href="{{route('home')}}" class="link">Here</a> to go home</p>
</div>
@endsection