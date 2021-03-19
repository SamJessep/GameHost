@extends('web.layouts.form')

@section('title')
    Verify Email
@endsection

@section('form')
<p>A verification email has been sent to {{$email}}, please confirm your email to finish signing up</p>
<form action="{{route('verification.send')}}" method="POST">
    @csrf
    <button class="btn-neutral" type="submit">Resend Email</button>
</form>

<a class="btn-neutral block" href="#open">
    Change email address
</a>
<form action="{{route('update-email')}}" method="POST" class="mt-5 hidden" id="change-email-form">
    @csrf
    <x-form.input label="New email" name="email" type="email" placeholder="newemail@example.com"/>
    <button class="btn-good" type="submit">Update</button>
</form>
<a class="btn-good block text-center" href="{{route('home')}}">
    Already verified ?
</a>
@endsection

@section('footer-scripts')
<script>
window.onhashchange=window.onload=() =>{
    if(window.location.hash.includes('#open')){
        document.getElementById('change-email-form').classList.remove('hidden')
    }
}
</script>
@endsection