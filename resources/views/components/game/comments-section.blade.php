<div class="mt-6" id="comments-container">
  <h1 class="text-2xl text-green-400 mb-6">Comments</h1>
  <form action="{{route('post-comment',["gameName"=>$game->name])}}" method="POST">
    @csrf
    <x-form.send-message-input size="10" fieldName="comment-new" />
  </form>

  <div>
    <div class="">
      @foreach ($game->GetComments() as $comment)
        <x-game.recursive-comments :comment="$comment" :game="$game"/>
      @endforeach
    </div>
  </div>
</div>