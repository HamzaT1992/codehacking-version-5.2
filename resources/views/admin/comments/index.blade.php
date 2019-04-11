@extends('layouts.admin')
@section('title')
    - Comments
@endsection
@section('content')
@if ($comments)
    <h1>Comments</h1>
    @if (Session::has('comment_deleted'))
        <p class="alert alert-success">{{ session('comment_deleted') }}</p>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post</th>
                <th>Created</th>
                <th>Approved</th>
                <th>Replies</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)    
            <tr>
                <td>{{ $comment->author }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ str_limit($comment->body, 20) }}</td>
                <td>{{ $comment->post->title }}</td>
                <td>{{ $comment->created_at->diffForHumans() }}</td>
                <td>
                    @if ($comment->is_active)
                    {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                    <input type="hidden" name="is_active" value="0">
                    <div class="form-group">
                        {!! Form::submit('Unapprove', ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                    @else
                    {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                    <input type="hidden" name="is_active" value="1">
                    <div class="form-group">
                        {!! Form::submit('Approve', ['class' => 'btn btn-info']) !!}
                    </div>
                    {!! Form::close() !!}  
                    @endif
                </td>
                <td>
                    @php
                        $repliesCount = $comment->replies->count();
                    @endphp
                    <a class="btn btn-primary {{ $repliesCount?'':'disabled' }}" href="{{ route('admin.comments.replies.show', $comment->id) }}">{{ $repliesCount }}</a>
                </td>
                <td><a href="{{ route('home.post', $comment->post->slug) }}" class="btn btn-primary">view post</a></td>
                <td>   
                    {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}
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
<h1>No Comments</h1>
@endif
@endsection