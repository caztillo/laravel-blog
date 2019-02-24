@extends('layouts.blog')
@section('content')

<div class="blog-post">
    <h2 class="blog-post-title">{{$post->title}}</h2>
    <p class="blog-post-meta"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{$post->created_at }} by <a href="#">{{$post->user->name}}</a></p>
    <h5>
    	<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Tags:
	    @forelse ($post->tags as $tag)
	    	<span class="label label-default">{{ $tag->name }}</span>&nbsp;
	    @empty
	    @endforelse
    </h5>
    <p>{{ $post->body }}</p>

</div><!-- /.blog-post -->

<nav>
<ul class="pager">
	<li><a href="{{ route('blogs.index') }}">Back</a></li>
</ul>
</nav>


@endsection