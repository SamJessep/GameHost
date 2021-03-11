<?php

namespace App\View\Components\game;

use Illuminate\View\Component;

class card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $game;
    public $author;
    public $user;
    
    public function __construct($game, $user)
    {
        $this->game = $game;
        $this->author = $game->AuthorUser();
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.game.card');
    }
}
