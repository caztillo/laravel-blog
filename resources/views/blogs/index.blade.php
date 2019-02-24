@extends('layouts.blog')
@section('content')
@foreach ($posts as $post)

<div class="blog-post">
    <h2 class="blog-post-title">{{$post->title}}</h2>
    <p class="blog-post-meta"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{$post->created_at }} by <a href="#">{{$post->user->name}}</a></p>
    <h5><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Tags:
        @forelse ($post->tags as $tag)
            <span class="label label-default">{{ $tag->name }}</span>&nbsp;
        @empty
        @endforelse
    </h5>
    <p>{{ str_limit($post->body, 144, '...') }}</p>
    <nav>
		<ul class="pager">
			<li><a href="{{ route('blogs.show',$post->slug) }}">Read more</a></li>
		</ul>
	</nav>
</div><!-- /.blog-post -->

@endforeach

<nav>
    <div class="text-center">
    {!! $posts->links() !!}
    <div>
</nav>
@endsection