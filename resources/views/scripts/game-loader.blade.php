<script>
const loader = document.getElementById('iframeLoader')
if(window.gameFrameLoaded){
  loader.classList.add('opacity-0')
   window.setTimeout(()=>loader.parentElement.removeChild(loader),2000)
}else{

  gameWindow.onload=e=>{
    console.log('frame loaded')
    loader.classList.add('opacity-0')
    window.setTimeout(()=>loader.parentElement.removeChild(loader),2000)
  }
}
</script>