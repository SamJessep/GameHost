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
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve" class="w-10 h-10 fill-current hover:text-green-400 transition-all text-white m-5">
    <g>
      <g>
        <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872
          c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872
          c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
          L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116
          c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952
          c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
          c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
      </g>
    </svg>
  </button>
  <h2 id="previewerTitle" class="text-white text-lg text-center"></h2>
  <img id="previewer" class="max-w-full max-h-full p-5 m-auto" src="" alt="Previewing users uploaded image">
</div>
@endsection

@section('footer-scripts')
  @include('scripts.upload-game-script')  
@endsection
