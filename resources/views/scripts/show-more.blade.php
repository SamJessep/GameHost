<script>

const showMoreBtn = document.getElementById('showMoreBtn')
const showLessBtn = document.getElementById('showLessBtn')
const rest = document.getElementById('rest')
if(showMoreBtn && showLessBtn && rest){
  showMoreBtn.onclick=e=>{
    rest.classList.remove("opacity-0", "h-0", "block", "overflow-hidden")
    showMoreBtn.classList.add('hidden')
    showLessBtn.classList.remove('hidden')
  }
  showLessBtn.onclick=e=>{
    rest.classList.add("opacity-0", "h-0", "block", "overflow-hidden")
    showMoreBtn.classList.remove('hidden')
    showLessBtn.classList.add('hidden')
  }
}
</script>