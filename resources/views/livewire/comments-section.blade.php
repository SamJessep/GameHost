<div id="comments-container" class="mt-6">
    <h1 class="text-2xl text-green-400 mb-6">Comments</h1>
    <form action="" wire:submit.prevent="postMessage">
        <x-form.send-message-input fieldName="newComment" size="10"/>
    </form>
        @foreach ($comments as $comment)
            <livewire:comment-card :comment="$comment" :game="$game" :key="$comment->id">
        @endforeach

</div>
