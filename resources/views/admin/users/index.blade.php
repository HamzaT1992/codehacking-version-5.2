@extends('layouts.admin')

@section('content')
    <h1>Users page</h1>

    @if (Session::has('user_deleted'))
        <p class="alert alert-success alert-dismissible">{{ session('user_deleted') }}</p>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($users)
                @foreach ($users as $user)    
                <tr>   
                    <td scope="row">{{ $user->id }}</td>
                    <td><img height="50px" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/50?text=No Photo' }}" alt=""></td>
                    <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        @if ($user->is_active)
                            <span class="text-success">active</span>
                        @else
                            <span class="text-danger">inactive</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
@endsection