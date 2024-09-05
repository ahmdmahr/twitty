@extends('layout.layout')

@section('title','Admin Dashboard')


@section('content')
<div class="row">
            <div class="col-3">
                @include('admin.left-sidebar')
            </div>
            <div class="col-9">
               <h1>Admin Dashboard</h1>

               <div class="row">
                   <div class="col-sm-6 col-md-4">
                       @include('includes.widget',
                       [
                           'title'=>'Total Users',
                           'icon'=>'fas fa-users',
                           'data'=>$totalUsers
                       ])
                   </div>
                   <div class="col-sm-6 col-md-4">
                    @include('includes.widget',
                    [
                        'title'=>'Total Posts',
                        'icon'=>'far fa-lightbulb',
                        'data'=>$totalPosts
                    ])
                   </div>
                   <div class="col-sm-6 col-md-4">
                    @include('includes.widget',
                    [
                        'title'=>'Total Comments',
                        'icon'=>'fas fa-comment',
                        'data'=>$totalComments
                    ])
                    </div>
               </div>
            </div>
</div>

@endsection

