<x-underline-card {{ $attributes }} class="min-w-1/3 transition-all">
    <div class="group bg-gray-100 p-3">
        @if($game->author == $user->username)
        <div class="flex justify-end h-8">
            <a class="text-green-600 hover:text-blue-500 absolute mr-3" href="{{route('edit-game', ["gameName"=>$game->name])}}">
                <x-icons.edit class="w-5 h-5 inline"/> Edit Game
            </a>
        </div>
        @endif
        <a class="block" href="{{route('load-game',['gameName'=>$game->name])}}">
            <img class="m-auto py-3 max-h-72 max-w-72" src={{env('GAME_STORE_URL').$game->thumbnailImage}} alt={{$game->name.'\'s thumbnail image'}}>
        </a>
        <a class="link block text-2xl pl-6 pb-5" href="{{route('load-game',['gameName'=>$game->name])}}">{{$game->name}}</a>
        <a class="" href="{{route('user',['username'=>$author->username])}}">
            <x-user.profile-picture :user="$author" class="m-0 inline" :size="10"/>
            <span class="link pl-3">{{$author->name}}</span>
        </a>
    </div>
</x-underline-card>