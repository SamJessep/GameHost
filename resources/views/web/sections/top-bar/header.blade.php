<header class="flex justify-between bg-black p-6">

<h1 class="link text-2xl font-bold"><a href="{{route("home")}}">Game Host</a></h1>

<ul class="flex w-1/4 justify-end flex-grow max-w-xl">
  @auth
    <li class="mx-4">
      @include('web.sections.top-bar.user-menu')
    </li>
    <form action="{{route('logout')}}" method="post" class="inline">
      @csrf
      <li class="mx-4"><button class="link focus:outline-none text-lg" type='submit'>Logout</button></li>
    </form>
  @endauth
  @guest
    <li class="mx-4"><a class="link" href="{{route("login")}}">Login</a></li>
    <li class="mx-4"><a class="link" href="{{route("register")}}">Register</a></li>
  @endguest
</ul>

</header>