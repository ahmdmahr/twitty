<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ $post->user->getImageURL() }}" alt="{{ $post->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show',$post->user->id)}}"> {{ $post->user->name }}
                        </a></h5>
                </div>
            </div>
            <div class="d-flex">

                @if(url()->current() != route('posts.show',$post->id))
                   <a href="{{ route('posts.show', $post->id)}}">View</a>
                @endif 

                @auth

                @can('update',$post)
                <a  class='mx-2' href="{{ route('posts.edit', $post->id)}}">Edit</a>
                @endcan

                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                   @csrf
                   @method('DELETE')
                
                   @can('delete',$post)
                   <button class="ms-1 btn btn-danger btn-sm"> X </button>  
                   @endcan

                </form>

                @endauth
                

            </div>
        </div>
    </div>
    <div class="card-body">
        {{-- if the var is undefined or null it will define it and set it to false --}}
        @if($editing ?? false)
        
        <form action="{{ route('posts.update',$post->id) }}" method="POST">
            @csrf
            @method('PUT')
        <div class="mb-3">
            <textarea  name='content' class="form-control" id="content" rows="3">{{ $post->content }}</textarea>
            @error('content')
                <span class="d-block fs-6 text-danger mt-2">
                    {{ $message }}
                </span> 
            @enderror
        </div>
        <div class="">
            <button type="submit" class="btn btn-dark mb-2"> Update </button>
        </div>
    </form>

        @else

        <p class="fs-6 fw-light text-muted">
            {{ $post->content }}
        </p>

        @endif

        <div class="d-flex justify-content-between">
            @include('posts.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                {{-- {{$post->created_at->diffForHumans()}} --}}
                {{$post->created_at}} </span>
            </div>
        </div>
        @include('includes.comments-box')
    </div>
</div>