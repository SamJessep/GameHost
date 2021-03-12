<div class="bg-gray-900">
  <div class="w-5/6 bg-gray-200">
    <h1 class="text-2xl text-center text-green-700 w-full">Opps Your Game Deployment failed</h1>
    <p class="w-full">{{$game->name}} has failed to upload</p>
    <pre class="bg-gray-900 text-red-700">{{$error->getMessage()}}</pre>
    <a href="{{route('upload-game')}}" class="btn-bad block w-5/6">Click here try again</a>
  </div>
</div>