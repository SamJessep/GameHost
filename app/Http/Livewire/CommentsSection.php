<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CommentsSection extends Component
{
    public $comments;
    public $game;

    public $message = "";

    public function postMessage(){
        Comment::Create([
            'gameId'=>$this->game->name,
            'author'=>Auth::user()->username,
            'message'=>$this->message
        ]);
        $this->message="";
    }

    public function render()
    {
        $this->comments = $this->game->GetComments()->sortByDesc('created_at');
        return view('livewire.comments-section');
    }
}
