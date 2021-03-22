@extends('web.layouts.error')

@section('title')
Not Found
@endsection

@section('error-body')
<h1 class="text-2xl text-center">Opps Page not found</h1>
<pre>{{$exception->getMessage()}}</pre>
@endsection