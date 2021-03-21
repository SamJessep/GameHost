<div class="mr-4 flex items-center">
    <p class="text-gray-600">{{count($likers)}}</p>
    <button class="group focus:outline-none @if ($liked) text-green-500 @else text-gray-500 @endif" wire:click="like">
        <x-icons.like class="h-6 group-hover:text-green-500"/>
    </button>
</div>
