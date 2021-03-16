<script>
  const commentsContainer = document.getElementById('comments-container');
  const toggleReplyField = target =>{
    var targetField = target.parentElement.querySelector('.reply-field')
    Array.from(commentsContainer.querySelectorAll('.reply-field')).forEach(field=>{
      field.classList[field == targetField ? 'toggle' : 'add']('hidden')
    })
  }
</script>