<div>
  <div class="bg-gray-300 rounded my-6 px-2 py-3">
    <x-game.author :author="$comment->GetUser()" class="mr-6"/>
    <p class="inline">{{$comment->message}}</p>
    <button class="float-right focus:outline-none group cursor-pointer" onclick="toggleReplyField(this)">
      <x-icons.reply class="h-8 text-gray-400 group-hover:text-green-500"></x-icons>
    </button>
    <form action="{{route('post-reply',["gameName"=>$game->name, "commentId"=>$comment->id])}}" method="POST">
      @csrf
      <x-form.send-message-input class="reply-field hidden" fieldName="comment-{{$comment->id}}"/>
    </form>
  </div>
  <div class="ml-6">
    {{ $slot }}
  </div>
</div>