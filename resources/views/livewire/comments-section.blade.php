<div id="comments-container" class="mt-6">
    <h1 class="text-2xl text-green-400 mb-6">Comments</h1>
    @auth
        <form action="" wire:submit.prevent="postMessage">
            <x-form.send-message-input fieldName="newComment" size="10"/>
        </form>
    @endauth
    @guest
        <div class="text-white text-lg text-center">
            <p>Please <a href="{{route('login')}}" class="link">Login</a> to post comments</p>
            <p>If you don't have an account you can Register <a href="{{route('register')}}" class="link">Here</a></p> 
        </div>
    @endguest
        @foreach ($comments as $comment)
            <livewire:comment-card :comment="$comment" :game="$game" :key="$comment->id">
        @endforeach

</div>
