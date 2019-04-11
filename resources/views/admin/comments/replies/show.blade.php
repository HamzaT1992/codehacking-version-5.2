@extends('layouts.admin')
@section('title')
    - Comment Replies
@endsection
@section('content')
@if ($comment->replies)
    <h1>Comment Replies of Post : {{ $comment->post->title }}</h1>
    @if (Session::has('comment_deleted'))
        <p class="alert alert-success">{{ session('comment_deleted') }}</p>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Created</th>
                <th>Approved</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comment->replies as $reply)    
            <tr>
                <td>{{ $reply->author }}</td>
                <td>{{ $reply->email }}</td>
                <td>{{ str_limit($reply->body, 20) }}</td>
                <td>{{ $reply->created_at->diffForHumans() }}</td>
                <td>
                    @if ($reply->is_active)
                    {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                    <input type="hidden" name="is_active" value="0">
                    <div class="form-group">
                        {!! Form::submit('Unapprove', ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                    @else
                    {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                    <input type="hidden" name="is_active" value="1">
                    <div class="form-group">
                        {!! Form::submit('Approve', ['class' => 'btn btn-info']) !!}
                    </div>
                    {!! Form::close() !!}  
                    @endif
                </td>
                <td><a href="{{ route('home.post', $comment->post->slug) }}" class="btn btn-primary">view post</a></td>
                <td>   
                    {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}
                    <div class="form-group">
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
<h1>No Replies</h1>
@endif
@endsection