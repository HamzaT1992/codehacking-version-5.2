@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <img class="img-responsive img-rounded" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400?text=No Photo' }}" alt="">
        </div>
    </div>
    <div class="row">
        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            @include('includes.form-error', ['value' => 'title'])
        </div>
        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', ['' => 'Choose Category ...'] + $categories, null, ['class' => 'form-control']) !!}
            @include('includes.form-error', ['value' => 'category_id'])
        </div>
        <div class="form-group{{ $errors->has('photo_id') ? ' has-error' : '' }}">
            {!! Form::label('photo_id', 'Choose image') !!}
            {!! Form::file('photo_id', ['class' => 'form-control']) !!}
            @include('includes.form-error', ['value' => 'photo_id'])
        </div> 
        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
            {!! Form::label('body', 'Content') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            @include('includes.form-error', ['value' => 'body'])
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary col-xs-4']) !!}
        </div>
        {!! Form::close() !!}
        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete', ['class' => 'btn btn-danger col-xs-4 col-xs-offset-4']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection