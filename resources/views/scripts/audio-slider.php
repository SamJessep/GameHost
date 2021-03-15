<script>
  const audioVal = document.getElementById('audioValue');
  const slider = document.getElementById('audioSlider');
  const mute = document.getElementById('mute-btn');
  const unmute = document.getElementById('unmute-btn');
  const gameWindow = document.getElementById('game-window');

  slider.oninput = e=>{
    var volumeLevel = e.target.value/100;
    audioVal.innerText = e.target.value+"%";
    muteGame(e.target.value==0);
    gameWindow.setVolume(volumeLevel);
  }

  mute.onclick = e => {
    muteGame(true)
  }

  unmute.onclick = e => {
    muteGame(false)
  }

const muteGame = (on)=>{
  [on?'add':'remove']
  unmute.classList[on?'remove':'add']('hidden')
  unmute.classList[on?'add':'remove']('inline')
  
  mute.classList[on?'remove':'add']('inline')
  mute.classList[on?'add':'remove']('hidden')
}
</script>
