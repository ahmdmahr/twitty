<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                
                <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                    src=" {{ $user->getImageURL() }} " alt="{{ $user->id }}">
                <div>
                    <h3 class="card-title mb-0"><a href="{{route('users.show',$user->id)}}"> {{ $user->name }}
                        </a></h3>
                    <span class="fs-6 text-muted">@mario</span>
                </div>
            </div>
            <div>
                {{-- can directive checks if the user is logged in or not before using policies or gates --}}
                @can('update',$user)
                <a href="{{ route('users.edit' ,$user->id)}}">Edit</a>
                @endcan
            </div>
        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> About : </h5>
            <p class="fs-6 fw-light">
                {{ $user->bio }} 
            </p>
            <div class="d-flex justify-content-start">
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> {{ $user->followers()->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{ $user->posts()->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-comment me-1">
                    </span> {{ $user->comments()->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $user->likedPosts()->count() }} </a>
            </div>
            
            @auth
            @if (auth()->id() != $user->id)
            <div class="mt-3">
                @if(Auth::user()->follows($user))
                {{-- @php 
                @endphp --}}
                <form method = "POST" action="{{ route('users.unfollow',$user->id)}}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm"> UnFollow </button>
                </form>
                @else
                <form method = "POST" action="{{ route('users.follow',$user->id)}}">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                </form> 
                @endif 
            </div>
            @endif
            @endauth
        </div>
    </div>
</div>
<hr>