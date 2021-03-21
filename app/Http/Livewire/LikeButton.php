<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CommentRating;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public $comment;
    public $liked;
    public $likers = [];

    public function like(){
        $user = Auth::user();
        $existingRatings = CommentRating::where('userId',$user->username)
            ->where('commentId',$this->comment->id)
            ->get();
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

    public function hasLiked(){
        return count(CommentRating::where('userId',Auth::user()->username)
        ->where('commentId',$this->comment->id)
        ->where('rating','like')
        ->get())>0;
    }

    public function render()
    {
        $this->likers = $this->comment->GetLikers();
        $this->liked = $this->hasLiked();
        return view('livewire.like-button');
    }
}
