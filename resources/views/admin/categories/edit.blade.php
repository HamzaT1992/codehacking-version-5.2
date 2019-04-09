@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3>Edit Category</h3>
        
            {!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id]]) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @include('includes.form-error', ['value' => 'name'])
            </div>
            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary col-xs-4']) !!}
            </div>
            {!! Form::close() !!}
            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger col-xs-4 col-xs-offset-4']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection