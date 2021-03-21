@extends('web.layouts.form')

@section('form')
<form action="@yield('postAction')" method="POST" enctype="multipart/form-data">
  @csrf
  <x-form.input label="Name" name="name" type="text" placeholder="Game name" value="{{isset($game) ? $game->name : old('name')}}" />
  <x-form.textarea label="Description" name="description" placeholder="Description" textAreaValue="{{isset($game) ? $game->description : old('description')}}" />
  <x-form.input id="gameFilesInput" label="Game Files Zip" name="gameZip" type="file" placeholder="Game name" accept=".zip">
    <small class="block text-gray-500">an index.html file must be in the root</small>
  </x-form.input>
  <x-form.input id="thumbnailInput" label="Preview Image/Thumbnail" name="previewImage" type="file" accept="image/*">
    <small class="block text-gray-500">This image will be shown in lists of games and used as the thumbnail for the game</small>
  </x-form.input>
  <div id="thumbnailPreviewContainer" class="flex flex-wrap"></div>
  <x-form.input id="gallaryInput" label="Gallary Images" name="gallaryImages[]" type="file" accept="image/*" multiple>
    <small class="block text-gray-500">These images will be shown on the details page for this game to give an overview of your game</small>
  </x-form.input>
  <div id="gallaryPreviewContainer" class="flex flex-wrap"></div>
  @yield('submitButton')
</form>

<div class="bg-gray-800 bg-opacity-75 fixed top-0 left-0 w-full h-full hidden">
  <button onclick="ClosePreview()" class="fixed left-0 top-0 outline-none">
    <x-icons.close class="w-10 h-10 fill-current hover:text-green-400 transition-all text-white m-5"/>
  </button>
  <h2 id="previewerTitle" class="text-white text-lg text-center"></h2>
  <img id="previewer" class="max-w-full max-h-full p-5 m-auto" src="" alt="Previewing users uploaded image">
</div>
@endsection

@section('footer-scripts')
  @include('scripts.upload-game-script')  
@endsection
