@auth
<h4> Share yours ideas </h4>
<div class="row">
    {{-- action can be {{ url('route path') }} OR {{ route('route name') }}--}}
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
    <div class="mb-3">
        <textarea  name='content' class="form-control" id="content" rows="3"></textarea>
        @error('content')
            <span class="d-block fs-6 text-danger mt-2">
                {{ $message }}
            </span> 
        @enderror
    </div>
    <div class="">
        <button type="submit" class="btn btn-dark btn-sm"> Share </button>
    </div>
</form>
</div>
@endauth
@guest
    {{-- <h4> {{ trans('posts.login_to_share') }} </h4> --}}
    {{-- <h4> @lang('posts.login_to_share') </h4> --}}
    
    <h4> {{ __('posts.login_to_share') }} </h4>
@endguest