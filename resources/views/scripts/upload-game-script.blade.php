<script>
const thumbnail = document.getElementById('thumbnailInput')
const gallary = document.getElementById('gallaryInput')

const thumbnailPreview = document.getElementById('thumbnailPreview')
const gallaryPreviewContainer = document.getElementById('gallaryPreviewContainer')

const previewImage = document.getElementById('previewer')
const previewTitle = document.getElementById('previewerTitle')

gallary.onchange=()=>{
  if(gallary.files.length > 0){
    var img;
    var container;
    for(let file of gallary.files){
      container = document.createElement('div')
      img = document.createElement('img')
      img.src = URL.createObjectURL(file)
      img.className = "w-full p-3"
      img.alt = "user uploaded gallary of images for their game"
      container.className = "w-1/3 border-b-4 hover:border-green-500 cursor-pointer"
      container.append(img)
      container.onclick=el=>ShowLarger(img.src, file.name)
      gallaryPreviewContainer.append(container)
    }
  }else{

  }
}

thumbnail.onchange=()=>{
  if(thumbnail.files.length > 0){
    thumbnailPreview.src = URL.createObjectURL(thumbnail.files[0]);
    thumbnailPreview.alt = "user uploaded thumbnail image"
    thumbnailPreview.parentElement.classList.remove("hidden")
    thumbnailPreview.onclick=el=>ShowLarger(thumbnailPreview.src, thumbnail.files[0].name)
  }else{
    thumbnailPreview.src = "";
  }
}


function ShowLarger(src, title){
  previewTitle.innerText = title
  previewImage.src=src
  previewImage.parentElement.classList.remove('hidden')
}

function ClosePreview(){
  previewImage.parentElement.classList.add('hidden')
  previewImage.src=""
}
</script>
