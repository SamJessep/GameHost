<a {{$attributes}} href="{{route('user',['username'=>$author->username])}}">
    <x-user.profile-picture :user="$author" class="m-0 inline" :size="10"/>
    <span class="link pl-3">{{$author->name}}</span>
</a>