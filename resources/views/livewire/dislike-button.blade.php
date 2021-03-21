<div class="flex items-center">
    <p class="text-gray-600">{{count($dislikers)}}</p>
    <button class="group focus:outline-none @if ($disliked) text-red-500 @else text-gray-500 @endif" wire:click="dislike">
        <x-icons.dislike class="h-6 group-hover:text-red-500"/>
    </button>
</div>
