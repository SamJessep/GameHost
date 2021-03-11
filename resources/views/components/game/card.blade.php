<x-underline-card {{ $attributes }} class="min-w-1/3 transition-all">
    <div class="group bg-gray-100 p-3">
        <a class="block" href="{{route('load-game',['gameName'=>$game->name])}}">
            <img class="m-auto py-3 max-h-72 max-w-72" src={{env('GAME_STORE_URL').$game->thumbnailImage}} alt={{$game->name.'\'s thumbnail image'}}>
        </a>
        <a class="link block text-2xl pl-6 pb-5" href="{{route('load-game',['gameName'=>$game->name])}}">{{$game->name}}</a>

        <div class="flex justify-between">
            <x-game.author class="author" :author="$author"/>
            @if($game->author == $user->username)
                <a class="text-green-600 hover:text-blue-500 mr-3 m-auto" href="{{route('edit-game', ["gameName"=>$game->name])}}">
                    <x-icons.edit class="w-5 h-5 inline"/> Edit Game
                </a>
            @endif
        </div>
    </div>
</x-underline-card>