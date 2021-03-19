<img
id="profile-picture"
  {{ $attributes->merge(['class' => 'rounded-full h-'.$size." w-".$size]) }}
  {{ $attributes }}
  @if (isset($src))
    src="{{$src}}"
  @elseif ($user->picture)
    src="{{env('GAME_STORE_URL').$user->picture}}"
  @else
    src="{{env('GAME_STORE_URL').env('CLOUD_SITEFILES_DIR').'/DEFAULT.png'}}"
  @endif
  alt="{{$user->name."'s profile picture"}}"
/> 