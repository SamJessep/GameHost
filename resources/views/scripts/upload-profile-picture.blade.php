<script>
const profile = document.getElementById('profile-picture')
const input = document.getElementById('profile-upload')
const preview = document.getElementById('preview-message');
const originalSource  = profile.src

input.onchange=()=>{
  if(input.files.length > 0){
    profile.src = URL.createObjectURL(input.files[0])
    preview.className = ""
  }else{
    profile.src = originalSource
    preview.className = "hidden"
  }
}
</script>