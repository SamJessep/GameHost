<div>
    <div class="bg-gray-300 rounded my-6 px-2 py-3">
      <x-game.author :author="$comment->GetUser()" class="mr-6"/>
      <p class="inline">{{$comment->message}}</p>
      <div class="float-right">
          <small class="text-gray-600">{{$comment->GetFormatedPostDate()}}</small>
          <button class="focus:outline-none group cursor-pointer" onclick="toggleReplyField(this)">
            <x-icons.reply class="h-8 text-gray-400 group-hover:text-green-500"></x-icons>
          </button>
      </div>
      <form wire:submit.prevent="postReply">
        @csrf
        <x-form.send-message-input class="reply-field hidden" fieldName="comment-{{$comment->id}}"/>
      </form>
    </div>
    <div class="ml-6">
        @foreach ($replies as $reply)
            <livewire:comment-card :comment="$reply" :game="$game" :key="$reply->id">
        @endforeach
    </div>
  </div>
