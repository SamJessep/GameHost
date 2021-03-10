@extends('web.layouts.form')

@section('title')
    Success!
@endsection

@section('form')
  <p>Your game has been submitted and is being processed, this may take up to 5 minutes</p>
  <a class="btn-good text-center block">Send me an email when my game is ready</a>
  <a class="btn-neutral block" href="{{route('home')}}">Home</a>
@endsection