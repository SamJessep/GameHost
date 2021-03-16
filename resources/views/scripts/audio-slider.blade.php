<script>
  const slider = document.getElementById('audioSlider');
  const mute = document.getElementById('mute-btn');
  const unmute = document.getElementById('unmute-btn');
  const gameWindow = document.getElementById('game-window');

  var lastSliderVal = slider.value;

  const SupportsAudioControls = ()=>{
    var audioInterface;
    try{
      audioInterface = gameWindow.contentWindow.C3Audio_DOMInterface.Hb.gain.value
    }catch(e){
      return false
    }
    console.log(audioInterface)
    return true
  }

  const SetAudioLevel = val=>gameWindow.contentWindow.C3Audio_DOMInterface.Hb.gain.value = val;

const muteGame = (on)=>{
  [on?'add':'remove']
  unmute.classList[on?'remove':'add']('hidden')
  unmute.classList[on?'add':'remove']('inline')
  
  mute.classList[on?'remove':'add']('inline')
  mute.classList[on?'add':'remove']('hidden')
}

var audioCheckCount = 0;
var audioChecker = setInterval(function(){
  audioCheckCount++
  console.log("Checking for audio support")
  var controlsEnabled = SupportsAudioControls()
  slider.disabled=!controlsEnabled
  if(!controlsEnabled){
    mute.classList=["player-btn-disabled"]
    unmute.classList=["hidden"]
    if(audioCheckCount>5) clearInterval(audioChecker)
  }else{
    clearInterval(audioChecker)
    slider.oninput = e=>{
      console.log(e.target.value)
      lastSliderVal = e.target.value;
      var volumeLevel = e.target.value/100;
      muteGame(e.target.value==0);
      SetAudioLevel(volumeLevel);
    }
  
    mute.onclick = e => {
      muteGame(true)
      SetAudioLevel(0);
    }
  
    unmute.onclick = e => {
      muteGame(false)
      SetAudioLevel(lastSliderVal/100);
    }
  }
  
}, 5000);
</script>
