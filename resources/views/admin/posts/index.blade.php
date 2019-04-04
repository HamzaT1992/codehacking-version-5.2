@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
    @if (Session::has('post_deleted'))
        <p class="alert alert-success">{{ session('user_deleted') }}</p>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @if ($posts)
                @foreach ($posts as $post)    
                <tr>
                    <td><img height="50px" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/50?text=No Photo' }}" alt=""></td>
                    <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                    <td>{{ $post->category ? $post->category->name : 'uncategorised' }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
@endsection