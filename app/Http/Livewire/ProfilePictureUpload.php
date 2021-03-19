<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Data\CloudController;

class ProfilePictureUpload extends Component
{

    use WithFileUploads;

    public $user;
    public $size;

    public $picture;

    public function uploadPicture(){
        $this->validate([
            'picture' => 'mimes:jpeg,png|max:625000',
        ]);
    }

    public function savePicture(){
        $this->user = UserController::storePicture(
                                            $this->picture,
                                            env('LIVEWIRE_TMP')."/".$this->picture->getFilename(),
                                            $this->user
                                        );
        $this->picture = null;
    }

    public function resetProfile(){
        CloudController::Delete($this->user->picture);
        $this->user->picture = '';
        $this->user->save();
    }

    public function render()
    {
        return view('livewire.profile-picture-upload');
    }
}
