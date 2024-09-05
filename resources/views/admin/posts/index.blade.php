@extends('layout.layout')

@section('title','Posts | Admin Dashboard')


@section('content')
<div class="row">
            <div class="col-3">
                @include('admin.left-sidebar')
            </div>
            <div class="col-9">
               <h1>Posts</h1>
               <table class="table mt-3">
                   <thead class="table-dark">
                       <tr>
                           <th>ID</th>
                           <th>User</th>
                           <th>Content</th>
                           <th>Created At</th>
                           <th>#</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($posts as $post)
                           
                       <tr>
                           <td>{{$post->id}}</td>
                           <td><a href="{{ route('users.show',$post->user->id) }}">{{ $post->user->name }}</a></td>
                           <td>{{$post->content}}</td>
                           <td>{{$post->created_at->toDateString()}}</td>
                           <td>
                               <a href="{{ route('posts.show',$post->id) }}">View</a>
                               <a href="{{ route('posts.edit',$post->id) }}">Edit</a>
                           </td>
                       </tr>

                       @endforeach
                   </tbody>
               </table>
               {{$posts->links()}}
            </div>
</div>

@endsection

