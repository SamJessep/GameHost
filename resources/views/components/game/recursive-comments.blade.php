<x-game.comment :comment="$comment" :game="$game">
  @foreach ($comment->GetReplies() as $reply)
    <x-game.recursive-comments :comment="$reply" :game="$game"/>      
  @endforeach
</x-game.comment>