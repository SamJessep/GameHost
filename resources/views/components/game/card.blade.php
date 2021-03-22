<x-underline-card {{ $attributes }} class="min-w-1/3 transition-all my-6 rounded">
    <div class="bg-gray-100 p-3">
        <div class="group">
            <a class="block" href="{{route('load-game',['gameName'=>$game->name])}}">
                <img class="m-auto py-3 max-h-72 max-w-72" src={{env('GAME_STORE_URL').$game->thumbnailImage}} alt={{$game->name.'\'s thumbnail image'}}>
            </a>
            <a class="link block text-2xl pl-6 pb-5 group-hover:text-green-800" href="{{route('load-game',['gameName'=>$game->name])}}">{{$game->name}}</a>
        </div>

        <div class="flex justify-between">
            <x-game.author class="author" :author="$author"/>
            @auth
                @if($game->author == $user->username)
                    <a class="text-green-600 hover:text-green-800 mr-3 m-auto" href="{{route('edit-game', ["gameName"=>$game->name])}}">
                        <x-icons.edit class="w-5 h-5 inline"/> Edit Game
                    </a>
                @endif
            @endauth
        </div>
    </div>
</x-underline-card>