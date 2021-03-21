<div class="flex mt-3">
    <div class="mr-4 flex items-center">
        <button class="text-gray-600 focus:outline-none" onclick="document.getElementById('userlist-like-{{$comment->id}}').classList.remove('hidden')">{{count($likers)}}</button>
        <button class="group focus:outline-none @if ($liked) text-green-500 @else text-gray-500 @endif" wire:click="like">
            <x-icons.like class="h-6 group-hover:text-green-500"/>
        </button>
        <x-user.person-list :reactors="$likers" id="userlist-like-{{$comment->id}}" title="Likes"/>
    </div>
    <div class="flex items-center">
        <button class="text-gray-600 focus:outline-none" onclick="document.getElementById('userlist-dislike-{{$comment->id}}').classList.remove('hidden')">{{count($dislikers)}}</button>
        <button class="group focus:outline-none @if ($disliked) text-red-500 @else text-gray-500 @endif" wire:click="dislike">
            <x-icons.dislike class="h-6 group-hover:text-red-500"/>
        </button>
        <x-user.person-list :reactors="$dislikers" id="userlist-dislike-{{$comment->id}}" title="Dislikes"/>
    </div>
</div>
