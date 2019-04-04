@extends('layouts.admin')

@section('content')
    <h1>Create User</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null,['class' => 'form-control']) !!}
        @include('includes.form-error', ['value' => 'name'])
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null,['class' => 'form-control']) !!}
        @include('includes.form-error', ['value' => 'email'])
    </div>
    <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
        {!! Form::label('role_id', 'Role') !!}
        {!! Form::select('role_id', ['' => 'choose role ...'] + $roles, null, ['class' => 'form-control']) !!}
        @include('includes.form-error', ['value' => 'role_id'])
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Status') !!}
        {!! Form::select('is_active', [ 1 => 'acitve', 0 => 'inactive' ], 0, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'Photo') !!}
        {!! Form::file('photo_id', ['class' => 'form-control-file']) !!}
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password',['class' => 'form-control']) !!}
        @include('includes.form-error', ['value' => 'password'])
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        {!! Form::label('password_confirmation', 'Comfirm Password') !!}
        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
        @include('includes.form-error', ['value' => 'password_confirmation'])
    </div>
    <div class="form-group">
        {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    
@endsection