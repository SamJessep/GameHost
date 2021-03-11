<img
  id="profile-picture"
  {{ $attributes->merge(['class' => 'rounded-full h-'.$size." w-".$size]) }}
  {{ $attributes }}
  src="{{asset($user->picture)}}" 
  alt="{{$user->name."'s profile picture"}}"
/> 