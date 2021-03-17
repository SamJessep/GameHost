<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeButton extends Component
{
    public $comment;
    public $liked;

    public function like(){
        $this->liked = !$this->liked;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
