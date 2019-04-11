@extends('layouts.admin')
@section('title')
    - Posts
@endsection

@section('content')
    <h1>Posts</h1>
    @if (Session::has('post_deleted'))
        <p class="alert alert-success">{{ session('post_deleted') }}</p>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Title</th>
                <th>Body</th>
                <th>Category</th>
                <th>Author</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Comments</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if ($posts)
                @foreach ($posts as $post)  
                @php
                    $commentCount = $post->comments->count()
                @endphp  
                <tr>
                    <td><img height="50px" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/50?text=No Photo' }}" alt=""></td>
                    <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                    <td>{{ str_limit($post->body, 20) }}</td>
                    <td>{{ $post->category ? $post->category->name : 'uncategorised' }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                    <td>
                        <a class="btn btn-primary {{ $commentCount?'':'disabled' }}" href="{{ route('admin.comments.show', $post->id) }}">{{ $commentCount }}</a>
                    </td>
                    <td><a href="{{ route('home.post', $post->id) }}" class="btn btn-success">view</a></td>
                </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
@endsection