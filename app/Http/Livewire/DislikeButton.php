<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CommentRating;
use Illuminate\Support\Facades\Auth;

class DislikeButton extends Component
{
    public $comment;
    public $disliked;
    public $dislikers = [];

    public function dislike(){
        $user = Auth::user();
        $existingRatings = CommentRating::where('userId',$user->username)
            ->where('commentId',$this->comment->id)
            ->get();
        if(count($existingRatings) != 0){
            foreach($existingRatings as $rating){
                $rating->delete();
            }
        }
        if(!$this->disliked){
            CommentRating::create([
                'commentId'=>$this->comment->id,
                'userId'=>$user->username,
                'rating'=>'dislike'
            ]);
        }
    }

    public function hasDisliked(){
        return count(CommentRating::where('userId',Auth::user()->username)
        ->where('commentId',$this->comment->id)
        ->where('rating','dislike')
        ->get())>0;
    }

    public function render()
    {
        $this->dislikers = $this->comment->GetDislikers();
        $this->disliked = $this->hasDisliked();
        return view('livewire.dislike-button');
    }
}
