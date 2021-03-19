@extends('web.layouts.form')

@section('title')
    Editing profile
@endsection

@section('form')
<livewire:profile-picture-upload size='60' :user="$user"/>
<form action="{{route('save-edits', ['username'=>$user->name])}}" method="POST">
  @csrf
  <x-form.input label="Name" name="name" type="text" :value="$user->name"/>
  <x-form.input label="Username" name="username" type="text" :value="$user->username"/>
  <x-form.textarea label="About me" name="about" :textAreaValue="$user->about"/>
  <label>Game Developer <input type="checkbox" name="isDev" @if($user->isDev) {{'checked'}} @endif></label>
  <input type="submit" value="Update" class="border-2 w-full rounded-lg p-2 bg-green-300 mt-4 hover:bg-green-900 hover:text-white cursor-pointer transition-all">
</form>
@endsection

@section('footer-scripts')
  @include('scripts.upload-profile-picture')  
  @livewireScripts()
@endsection