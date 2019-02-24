@extends('layouts.app')
<!-- Push a style dynamically from a view -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                <h4 class="pull-left">{{ $post->title }}</h4>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
                    </div>
                </div>
                
                <div class="panel-body">
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                            <strong>Tags:</strong> 
                            @forelse ($post->tags as $tag)
                                {{ $tag->name }}&nbsp;
                            @empty
                            @endforelse
                            
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <p>{{$post->body}}</p>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


