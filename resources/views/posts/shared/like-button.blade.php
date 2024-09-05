<div>
    @auth
        
    @if(auth()->user()->liked($post))

    <form action="{{ route('posts.unlike',$post->id) }}" method="POST">
        @csrf
        <button type="submit" class="fw-light nav-link fs-6"> <span
                class="fas fa-heart me-1">
            </span> {{ $post->likedByUsers()->count() }} </button>
    </form>
    
    @else

    <form action="{{ route('posts.like',$post->id) }}" method="POST">
        @csrf
        <button type="submit" class="fw-light nav-link fs-6"> <span
                class="far fa-heart me-1">
            </span> {{ $post->likedByUsers()->count() }} </button>
    </form>

    @endif
    @endauth

    @guest
    <a href="{{ route('login') }}" class="fw-light nav-link fs-6"> <span
        class="far fa-heart me-1">
    </span> {{ $post->likedByUsers()->count() }} </a>
    @endguest

</div>