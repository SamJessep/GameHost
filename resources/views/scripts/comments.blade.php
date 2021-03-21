<script>
  const commentsContainer = document.getElementById('comments-container');
  const toggleReplyField = targetId =>{
    var targetField = document.getElementById(targetId)
    Array.from(commentsContainer.querySelectorAll('.reply-field')).forEach(field=>{
      field.classList[field == targetField ? 'toggle' : 'add']('hidden')
    })
  }
</script>