@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                <h4 class="pull-left">Posts</h4>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('posts.create') }}"> New Post</a>
                    </div>
                </div>
                
                <div class="panel-body">

                     @if(Session::has('message'))
                        <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            {{ Session::get('message')}}
                        </div>
                    @endif

                   
                    <table class="table table-bordered">
                        <tr>
                            <th width="50px">No</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                   
                                    <a class="btn btn-default" href="{{ route('posts.show',[$post->id, $post->slug]) }}">Show</a>
                    
                                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                   
                                    {{ csrf_field() }}
                                    
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {!! $posts->links() !!} 
                    <div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection