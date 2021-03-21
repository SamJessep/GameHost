<script>
const loader = document.getElementById('iframeLoader')
gameWindow.addEventListener("load", function() {
  loader.classList.add('opacity-0')
  window.setTimeout(()=>loader.parentElement.removeChild(loader),2000)
  gameWindow.contentDocument.onkeydown=document.onkeydown
});

</script>