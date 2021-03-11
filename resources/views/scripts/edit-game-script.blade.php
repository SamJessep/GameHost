<script>
  const deleteConfirmationWindow = document.getElementById('deleteConfirmation')

  function ShowDeleteConfirmation(){
    deleteConfirmationWindow.classList.remove('hidden')
    deleteConfirmationWindow.classList.add('flex')
  }

  function HideDeleteConfirmation(){
    deleteConfirmationWindow.classList.add('hidden')
    deleteConfirmationWindow.classList.remove('flex')
  }

//Load existing images into previewer

const existingThumbnailImageContainer = document.getElementById('oldThumbnail')
const existingGallaryImagesContainer = document.getElementById('oldGallary')

if(existingGallaryImagesContainer.children.length>0){
  for(let existingImg of existingGallaryImagesContainer.children){
    gallaryPreviewContainer.append(
      MakePreviewCard(existingImg.src,'existing gallary image',"user uploaded gallary of images for their game")
    )
  }
}

if(existingThumbnailImageContainer.children.length>0){
  for(let existingImg of existingThumbnailImageContainer.children){
    thumbnailPreviewContainer.append(
      MakePreviewCard(existingImg.src,'existing thumbnailImage image',"user uploaded gallary of images for their game")
    )
  }
}
</script>
  