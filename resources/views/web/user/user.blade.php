@extends('web.layouts.middle')

@section('title')
    {{$user->username}}
@endsection

@section('form')
@include('web.user.profile-picture')
<h1 class="text-center text-2xl">{{$user->name}}</h1>
<small class="text-center text-gray-700 block">{{$user->username}}</small>
@auth
    @if (auth()->user()->username == $user->username)
        @include('web.user.owner', ['user'=>$user])
    @endif
@endauth
<p>{{$user->about}}</p>
@endsection