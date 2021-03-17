<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DislikeButton extends Component
{
    public $comment;
    public $disliked;

    public function dislike(){
        //Add or remove like to database
        $this->disliked = !$this->disliked;
    }

    public function render()
    {
        return view('livewire.dislike-button');
    }
}
