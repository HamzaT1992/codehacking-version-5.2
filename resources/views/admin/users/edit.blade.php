@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>
    <div class="col-sm-3">
        <img class="img-responsive img-rounded" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400?text=No Photo' }}" alt="">
    </div>
    <div class="col-sm-9">
        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUserController@update', $user->id], 'files' => true]) !!}
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
            {!! Form::select('is_active', [ 1 => 'acitve', 0 => 'inactive' ], null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::label('photo_id', 'Photo') !!}
                {!! Form::file('photo_id', ['class' => 'form-control']) !!}
            </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'New Password') !!}
            {!! Form::password('password',['class' => 'form-control']) !!}
            @include('includes.form-error', ['value' => 'password'])
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {!! Form::label('password_confirmation', 'Comfirm New  Password') !!}
            {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
            @include('includes.form-error', ['value' => 'password_confirmation'])
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection