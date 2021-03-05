@extends('web.layouts.form')

@section('title')
    Editing profile
@endsection

@section('form')
  @include('web.user.profile-picture')
  <form action="{{route('upload-picture',['username'=>$user->username])}}" method="post" enctype="multipart/form-data">
    @csrf
    <label>Profile picture
      <input id="image" name="image" type="file" accept="image/*" class="w-full">
    </label>
    @error('image')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <div class="flex">
      <input type="submit" value="Upload" class="btn-good"/>
      <button class="btn-bad">Delete</button>
    </div>
  </form>

  <form action="{{route('save-edits', ['username'=>$user->username])}}" method="POST">
    @csrf
    <label>Name
      <input name="name" type="text" value="{{$user->name}}" class="form-field">
    </label>
    @error('name')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>Username
      <input name="username" type="text" value="{{$user->username}}" class="form-field">
    </label>
    @error('username')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>About me
      <textarea name="about" class="form-field">{{$user->about}}</textarea>
    </label>
    @error('about')
      <div class="text-red-500">{{$message}}</div>
    @enderror
    <label>Game Developer <input type="checkbox" name="isDev" @if($user->isDev) {{'checked'}} @endif></label>
    <input type="submit" value="Update" class="border-2 w-full rounded-lg p-2 bg-green-300 mt-4 hover:bg-green-900 hover:text-white cursor-pointer transition-all">
  </form>
@endsection