<header class="flex justify-between bg-black p-6">

<h1 class="link text-2xl font-bold"><a href="{{route("home")}}">Game Host</a></h1>

<ul class="flex flex-row w-1/4 justify-evenly">
  @auth
    <li><a class="link text-lg" href="{{route('user',Auth::user()->username)}}">{{Auth::user()->name}}</a></li>
    @if(Auth::user()->isDev)
      <li><a class="link text-lg" href="#MYGAMES">My Games</a></li>
    @endif
    <form action="{{route('logout')}}" method="post" class="inline">
      @csrf
      <li><button class="link outline-none text-lg" type='submit'>Logout</button></li>
    </form>
  @endauth
  @guest
    <li><a class="link" href="{{route("login")}}">Login</a></li>
    <li><a class="link" href="{{route("register")}}">Register</a></li>
  @endguest
</ul>

</header>