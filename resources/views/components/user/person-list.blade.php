<div {{$attributes}} class="bg-gray-800 bg-opacity-80 w-screen h-screen fixed top-0 left-0 hidden">
    <div class="bg-gray-200 p-7 absolute-center rounded w-2/3">
        <div class="w-full">
            <button class="absolute right-2 top-2 focus:outline-none" onclick="document.getElementById('{{$id}}').classList.add('hidden')">
                <x-icons.close class="h-8 w-8 hover:text-green-500"/>
            </button>
            <h2 class="text-2xl text-center">{{$title ?? ""}}</h2>
        </div>
        <ul>
            @forelse ($reactors as $reaction)
            <li>
                <a href="{{route('user',['username'=>$reaction->GetUser()->username])}}" class="group">
                    <x-user.profile-picture size="10" :user="$reaction->GetUser()" class="inline"/>
                        <span class="link group-hover:underline text-lg ml-4">
                            {{$reaction->GetUser()->name}}
                        </span>
                </a>
            </li>
            @empty
                <li>No {{$title}}</li>
            @endforelse
        </ul>
    </div>
</div>