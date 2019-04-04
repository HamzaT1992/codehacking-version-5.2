@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true]) !!}
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
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection