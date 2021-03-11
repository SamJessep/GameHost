<?php

namespace App\View\Components\user;

use Illuminate\View\Component;

class profilePicture extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public $size;
    public function __construct($user, $size='24')
    {
        $this->user=$user;
        $this->size=$size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user.profile-picture');
    }
}
