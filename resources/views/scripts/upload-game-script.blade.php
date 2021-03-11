<script>
const thumbnail = document.getElementById('thumbnailInput')
const gallary = document.getElementById('gallaryInput')

const thumbnailPreviewContainer = document.getElementById('thumbnailPreviewContainer')
const gallaryPreviewContainer = document.getElementById('gallaryPreviewContainer')

const previewImage = document.getElementById('previewer')
const previewTitle = document.getElementById('previewerTitle')

gallary.onchange=()=>{
  gallaryPreviewContainer.innerHTML=""
  if(gallary.files.length > 0){
    for(let file of gallary.files){
      var imgCard = MakePreviewCard(URL.createObjectURL(file),file.name,"user uploaded gallary of images for their game")
      gallaryPreviewContainer.append(imgCard)
    }
  }
}

thumbnail.onchange=()=>{
  thumbnailPreviewContainer.innerHTML=""
  if(thumbnail.files.length > 0){
    var imgCard = MakePreviewCard(URL.createObjectURL(thumbnail.files[0]), thumbnail.files[0].name, "user uploaded thumbnail image")
    thumbnailPreviewContainer.append(imgCard)
    // thumbnailPreview.parentElement.classList.remove("hidden")
    // thumbnailPreview.onclick=el=>ShowLarger(thumbnailPreview.src, thumbnail.files[0].name)
  }
}


function MakePreviewCard(src,filename,alt){
  var container = document.createElement('div')
  var img = document.createElement('img')
  img.src = src
  img.className = "max-h-60 p-3 m-auto"
  img.alt = alt
  container.className = "xl:1/6 lg:w-1/5 md:w-1/3 w-1/2 border-b-4 hover:border-green-500 cursor-pointer"
  container.append(img)
  container.onclick=el=>ShowLarger(src, filename)
  return container
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
