<header class="flex justify-between bg-black p-6">

<h1 class="link text-2xl font-bold"><a href="{{route("home")}}">Game Host</a></h1>

<ul class="flex w-1/4 justify-end flex-grow max-w-xl">
  @auth
    <li class="mx-4">
      <x-user.profile-picture :user="Auth::user()" class="inline" size="4"/>
      <a class="link text-lg inline" href="{{route('user',Auth::user()->username)}}">{{Auth::user()->name}}</a>
    </li>
    @if(Auth::user()->isDev)
      <li class="mx-4"><a class="link text-lg" href="{{route('my-games')}}">My Games</a></li>
    @endif
    <form action="{{route('logout')}}" method="post" class="inline">
      @csrf
      <li class="mx-4"><button class="link outline-none text-lg" type='submit'>Logout</button></li>
    </form>
  @endauth
  @guest
    <li class="mx-4"><a class="link" href="{{route("login")}}">Login</a></li>
    <li class="mx-4"><a class="link" href="{{route("register")}}">Register</a></li>
  @endguest
</ul>

</header>