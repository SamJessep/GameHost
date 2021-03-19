<div class="flex">
  <div class="mx-auto">
  {{-- USER PROFILE PICTURE/PREVIEW --}}
  @if ($picture)
    <p class="text-center text-lg">Photo Preview</p>
    <x-user.profile-picture :user="$user" :size="$size" src="{{ $picture->temporaryUrl() }}"/>
  @else
    <x-user.profile-picture :user="$user" :size="$size" />
  @endif

  {{-- LOADING INDICATOR --}}
  <div wire:loading wire:target="picture" class="w-full">
    <p class="mx-auto">UPLOADING ...</p>
  </div>

  {{-- UPLOAD, DELETE BUTTONS  --}}
  <div class="flex justify-around">
    <input type="file" id="uploadInput" wire:model="picture" wire:change="uploadPicture" hidden>
    {{-- file select button --}}
    <button onclick="document.getElementById('uploadInput').click()" class="focus:outline-none"><x-icons.upload class="h-8 hover:text-green-500"/></button>
    @if($user->picture)
      {{-- delete button --}}
      <button class="focus:outline-none" onclick="document.getElementById('confirmation-modal').classList.remove('hidden')">
        <x-icons.delete class="h-8 hover:text-red-500"/>
      </button>
      {{-- delete confirmation modal --}}
      <div id="confirmation-modal" class="bg-gray-800 bg-opacity-80 w-screen h-screen absolute top-0 left-0 hidden">
        <div class="bg-gray-200 p-7 absolute-center rounded">
          <h2>Are you sure you want to delete your profile picture?</h2>
          <button class="btn-good" onclick="document.getElementById('confirmation-modal').classList.add('hidden')">No go back</button>
          <button class="btn-bad" onclick="this.innerText='Deleting...'" wire:click="resetProfile">Yes i'm sure</button>
        </div>
      </div>
    @endif
  </div>
  @if ($picture)
    <button wire:click="savePicture" class="btn-good" onclick="this.innerText='Saving...'">Apply</button>
  @endif   
  </div>
</div>
