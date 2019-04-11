@extends('layouts.blog-post')

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/900x300' }}" alt="Post Image">

    <hr>

    <!-- Post Content -->
    <p>{{ $post->body }}</p>

    <hr>

    <!-- Blog Comments -->
    @if (Auth::check())
        <!-- Comments Form -->
        <div class="well">
            @if (Session::has('commented'))
            <p class="alert alert-success">{{ session('commented') }}</p>
            @endif
            @if (Session::has('replied'))
            <p class="alert alert-success">{{ session('replied') }}</p>
            @endif
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                {!! Form::textarea('body', null, ['class' => 'form-control',  'rows' => '3']) !!}
                @include('includes.form-error', ['value' => 'body'])
            </div>
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <hr>

        <!-- Posted Comments -->

        <!-- Comment -->
        @php
        $comments = $post->comments->where('is_active', 1);
        @endphp
        @if ($comments->count())
            @foreach ($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" height="64" width="64" src="{{ Gravatar::get($comment->email) }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->author }}
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </h4>
                    <p>{{ $comment->body }}</p>
                    {{-- Reply --}}
                    @include('includes.reply', ['comment' => $comment])
                    {{-- End Reply --}}
                    <!-- Nested Comment -->
                    @php
                    $replies = $comment->replies->where('is_active', 1);
                    @endphp
                    @if ($replies->count())

                        @foreach ($replies as $reply)
                            
                        @endforeach
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" height="64" width="64" src="{{ Gravatar::get($reply->email) }}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $reply->author }}
                                    <small>{{ $reply->created_at->diffForHumans() }}</small>
                                </h4>
                                <p>{{ $reply->body }}</p>
                                {{-- Reply --}}
                                @include('includes.reply', ['comment' => $reply])
                                {{-- End Reply --}}
                            </div>
                        </div>
                    @endif
                    <!-- End Nested Comment -->
                </div>
            </div>    
            @endforeach
        @endif
        <!-- Comment -->
    @else
    <h4 class="well">You must be loged in to see the comment section</h4>
    @endif
@endsection