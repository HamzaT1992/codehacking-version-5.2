@extends('layouts.admin')
@section('title')
    - Medias
@endsection
@section('content')
    <h1>Medias</h1>
    @if (Session::has('photo_deleted'))
        <p class="alert alert-success">{{ session('photo_deleted') }}</p>
    @endif
    @if ($photos)
    <div class="col-sm-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>               
                @foreach ($photos as $photo)    
                <tr>
                    <td><img height="50px" src="{{ $photo->file }}" alt=""></td>
                    <td>{{ $photo->file }}</td>
                    <td>{{ $photo->created_at->diffForHumans() }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
    @endif
@endsection