<div {{ $attributes }} class="bg-green-300 min-w-1/3">
    <a href="{{route('load-game',['gameName'=>$title])}}">
        <h2>{{$title}}</h2>
        <img src={{$thumbnailImg}} alt={{$title.'\'s thumbnail image'}}>
    </a>
    <a href="{{route('edit-game', ["gameName"=>$title])}}">Edit Game</a>
</div>