<script>
const sliderContainer = document.getElementById('slider');

const nextBtn = document.getElementById('next-btn');
const backBtn = document.getElementById('back-btn');

var currentIndex = 0;


const gallaryImages = sliderContainer.querySelectorAll('.gallaryImage')
const gallaryPreviewButtons = document.querySelectorAll(".gallaryPreviewButton")

const ChangeImage = index =>{
  currentIndex = index;
  for(let i = 0; i<gallaryImages.length; i++){
    gallaryImages[i].classList[i==index?"remove":"add"]("hidden")
  }
}

Array.from(gallaryPreviewButtons).forEach((btn,index)=>btn.onclick=e=>ChangeImage(index))

ChangeImage(0)
nextBtn.onclick = e=>ChangeImage(currentIndex+1<gallaryImages.length ? currentIndex+1 : 0)
backBtn.onclick = e=>ChangeImage(currentIndex-1>=0 ? currentIndex-1 : gallaryImages.length-1)
</script>