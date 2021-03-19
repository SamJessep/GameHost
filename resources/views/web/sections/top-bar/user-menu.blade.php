<div class="dropdown">
  <a class="link text-lg inline" href="{{route('user',Auth::user()->username)}}">
    <x-user.profile-picture :user="Auth::user()" class="inline" size="4"/>
    {{Auth::user()->name}}
  </a>
  <div class="dropdown-content bg-gray-200 rounded p-3">
    <ul>
      @if(Auth::user()->isDev)
        <li class="mx-4"><a class="link text-lg" href="{{route('my-games')}}">My Games</a></li>
      @endif
      @include('web.sections.top-bar.user-menu-button', [
        'text'=>"Edit Profile",
        'route'=>route('edit-user',['username'=>Auth::user()->username])
        ])
    </ul>
  </div>
</div>