<div>
    <div class="bg-gray-300 rounded my-6 px-2 py-3">
      <div class="flex">
        <x-game.author :author="$comment->GetUser()" class="mr-6"/>
          <p class="flex-grow break-all">{{$comment->message}}</p>
          <div class="ml-3">
              
              <button class="focus:outline-none group cursor-pointer" onclick="toggleReplyField('{{$comment->id}}-reply-field')">
                <x-icons.reply class="h-8 text-gray-400 group-hover:text-green-500"></x-icons>
              </button>
          </div>
      </div>
      <small class="text-gray-600 float-right">{{$comment->GetFormatedPostDate()}}</small>
      <div>
        @auth
        <livewire:react-buttons :comment="$comment"/>
        @endauth
      </div>
      <form wire:submit.prevent="postReply">
        @csrf
        <x-form.send-message-input class="reply-field hidden" fieldName="comment-{{$comment->id}}" id="{{$comment->id}}-reply-field"/>
      </form>
    </div>
    <div class="ml-6">
        @foreach ($replies as $reply)
            <livewire:comment-card :comment="$reply" :game="$game" :key="$reply->id">
        @endforeach
    </div>
  </div>
