<script>
gameWindow.contentWindow.focus()
var baseDocument = document;
gameWindow.contentWindow.onfocus = ()=>{
  alert('focused')
  baseDocument.onkeydown = e=>{
    console.log(e)
    if(gameWindow)
    e.preventDefault()
  }
}
gameWindow.contentWindow.onblur = ()=>{
  alert("blured")
  baseDocument.onkeydown=null
}

</script>