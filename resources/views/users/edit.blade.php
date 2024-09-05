@extends('layout.layout')

@section('title','Edit Profile')


@section('content')
<div class="row">
            <div class="col-3">
                @include('includes.left-sidebar')
            </div>
            <div class="col-6">
                @include('includes.success-message')
                <div class="mt-3">
                    <div class="card">
                        <div class="px-3 pt-4 pb-2">
                            <form enctype="multipart/form-data" method="POST" action="{{route('users.update',$user->id)}}">
                                @csrf
                                @method('PUT')
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    
                                    <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                                        src="{{ $user->getImageURL() }}" alt="Mario Avatar">
                                    <div>
                                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                                        @error('name')
                                            <span class="text-danger fs-6">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @if (auth()->id() == $user->id)
                                    <a href="{{ route('users.show' ,$user->id)}}">View</a>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="">Profile Picture</label>
                                <input name="image" class="form-control" type="file">
                                @error('image')
                                            <span class="text-danger fs-6">{{ $message }}</span>
                                        @enderror
                            </div>
                            <div class="px-2 mt-4">
                                <h5 class="fs-5"> Bio : </h5>
                                <div class="mb-3">
                                    <textarea  name='bio' class="form-control" id="bio" rows="3"> {{ $user->bio }} </textarea>
                                    @error('bio')
                                        <span class="d-block fs-6 text-danger mt-2">
                                            {{ $message }}
                                        </span> 
                                    @enderror
                                </div>
                                <button class="btn btn-dark btn-sm mb-3">Save</button>
                                <div class="d-flex justify-content-start">
                                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                                        </span> 0 Followers </a>
                                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                                        </span> {{ $user->posts()->count() }} </a>
                                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                                        </span> {{ $user->comments()->count() }} </a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <hr>
                </div>

            </div>
            <div class="col-3">
            @include('includes.search-bar')
            @include('includes.follow-box')
            </div>
</div>

@endsection
