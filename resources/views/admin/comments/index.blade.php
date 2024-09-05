@extends('layout.layout')

@section('title','Comments | Admin Dashboard')


@section('content')
<div class="row">
            <div class="col-3">
                @include('admin.left-sidebar')
            </div>
            <div class="col-9">
               <h1>Comments</h1>
               @include('includes.success-message')
               <table class="table mt-3">
                   <thead class="table-dark">
                       <tr>
                           <th>ID</th>
                           <th>User</th>
                           <th>Post</th>
                           <th>Content</th>
                           <th>Created At</th>
                           <th>#</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($comments as $comment)
                           
                       <tr>
                           <td>{{$comment->id}}</td>
                           <td><a href="{{ route('users.show',$comment->user->id) }}">{{ $comment->user->name }}</a></td>
                           <td><a href="{{ route('posts.show',$comment->post->id) }}">{{ $comment->post->id }}</a></td>
                           <td>{{ $comment->content }}</td>
                           <td>{{ $comment->created_at->toDateString() }}</td>
                           <td>
                               <form action="{{ route('admin.comments.destroy',$comment)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit">Delete</button>
                               </form>
                           </td>
                       </tr>

                       @endforeach
                   </tbody>
               </table>
               {{$comments->links()}}
            </div>
</div>

@endsection

