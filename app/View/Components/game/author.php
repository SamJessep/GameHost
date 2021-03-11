<?php

namespace App\View\Components\game;

use Illuminate\View\Component;

class author extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $author;
    public function __construct($author)
    {
        $this->author = $author;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.game.author');
    }
}
