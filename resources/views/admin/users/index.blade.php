@extends('layouts.admin')

@section('content')
    <h1>Users page</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
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
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->is_active ? 'active' : 'inactive'}}</td>
                </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
@endsection