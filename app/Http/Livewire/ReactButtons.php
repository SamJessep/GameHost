<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CommentRating;
use Illuminate\Support\Facades\Auth;

class ReactButtons extends Component
{
    public $comment;
    
    public $disliked;
    public $dislikers = [];

    public $liked;
    public $likers = [];

    public function like(){
        $user = Auth::user();
        $existingRatings = CommentRating::where('userId',$user->username)
            ->where('commentId',$this->comment->id)
            ->get();
        $this->liked = $this->hasReacted('like');
        if(count($existingRatings) != 0){
            foreach($existingRatings as $rating){
                $rating->delete();
            }
        }
        if(!$this->liked){
            CommentRating::create([
                'commentId'=>$this->comment->id,
                'userId'=>$user->username,
                'rating'=>'like'
            ]);
        }
    }

    public function dislike(){
        $user = Auth::user();
        $existingRatings = CommentRating::where('userId',$user->username)
            ->where('commentId',$this->comment->id)
            ->get();
        $this->disliked = $this->hasReacted('dislike');
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

    public function hasReacted($reaction){
        return count(CommentRating::where('userId',Auth::user()->username)
        ->where('commentId',$this->comment->id)
        ->where('rating',$reaction)
        ->get())>0;
    }

    public function render()
    {
        $this->dislikers = $this->comment->GetDislikers();
        $this->likers = $this->comment->GetLikers();
        $this->disliked = $this->hasReacted('dislike');
        $this->liked = $this->hasReacted('like');
        return view('livewire.react-buttons');
    }
}
