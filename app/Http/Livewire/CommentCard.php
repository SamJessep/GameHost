<?php

namespace App\Http\Livewire;

use App\Models\Games;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CommentCard extends Component
{
    public $comment;
    public $replies = [];
    public $game;

    public string $message = "";
    

    public function postReply(){
        Comment::Create([
            'gameId'=>$this->game->name,
            'author'=>Auth::user()->username,
            'message'=>$this->message,
            'destinationId'=>$this->comment->id
        ]);
        $this->message="";
        $this->replies = $this->comment->GetReplies()->sortByDesc('created_at');
    }

    public function render()
    {
        $this->replies = $this->comment->GetReplies()->sortByDesc('created_at');
        return view('livewire.comment-card');
    }
}
