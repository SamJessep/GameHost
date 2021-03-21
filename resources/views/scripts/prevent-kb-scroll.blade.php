<script>
document.onkeydown = e => {
  if(!['input'].includes(document.activeElement.tagName.toLowerCase()) && [32,37,38,39,40].includes(e.keyCode)){
    e.preventDefault()
  }
}
</script>