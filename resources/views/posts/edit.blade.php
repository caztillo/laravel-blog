@extends('layouts.app')
<!-- Push a style dynamically from a view -->
@push('styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                <h4 class="pull-left">Add New Post</h4>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
                    </div>
                </div>
                
                <div class="panel-body">
                   @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                        </div>
                    @endif
                       
                    <form action="{{ route('posts.update',$post->id) }}" method="POST">
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                      
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group required has-feedback {{ ($error = $errors->first('title')) ? 'has-error' : '' }}">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{$post->title}}">
                                    <span class="help-block">{{ ($error = $errors->first('title')) ? $error : '' }}</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group required has-feedback {{ ($error = $errors->first('tags')) ? 'has-error' : '' }}">
                                    <strong>Tags:</strong>
                                    <select name="tags[]" data-ajax--url="{{url('admin/tags')}}" data-ajax--cache="true" multiple="multiple" data-placeholder="Tags" data-tags="true" data-allow-clear="true" class="form-control select2-ajax"></select>
                                    <span class="help-block">{{ ($error = $errors->first('tags')) ? $error : '' }}</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group required has-feedback {{ ($error = $errors->first('body')) ? 'has-error' : '' }}">
                                    <strong>Body:</strong>
                                    <textarea class="form-control" style="height:150px" name="body" placeholder="Body">{{$post->body}}</textarea>
                                    <span class="help-block">{{ ($error = $errors->first('body')) ? $error : '' }}</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Push a script dynamically from a view -->
@push('scripts')
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script>
    $(document).ready(function(){

        @forelse ($post->tags as $tag)
            $('select[name="tags[]"]').append($("<option/>", {
                value: '{{ $tag->id }}',
                text: '{{ $tag->name }}',
                selected: true
            }));

        @empty
        @endforelse

         $('.select2-ajax').select2(
            {
                theme: "bootstrap",
                ajax:
                {
                    dataType: 'json',
                    data: function (params)
                    {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    results: function (data, page)
                    {
                        return
                        {
                            results: data
                        };
                    }
                }

            });

    }); //End Document Ready
    </script>
@endpush

