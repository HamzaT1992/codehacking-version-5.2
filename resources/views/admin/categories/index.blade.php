@extends('layouts.admin')
@section('title')
    - Categories
@endsection
@section('content')
    <h1>Categories</h1>
    @if (Session::has('category_deleted'))
        <p class="alert alert-success">{{ session('category_deleted') }}</p>
    @endif
    <div class="col-sm-6">
        <div style="padding : 2.5rem; border : solid 1px #4286f4">
            <h3>Add Category</h3>
            {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @include('includes.form-error', ['value' => 'name'])
            </div>
            <div class="form-group">
                {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-sm-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Posts</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @if ($categories)
                    @foreach ($categories as $category)    
                    <tr>
                        <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                        <td>{{ $category->posts ? $category->posts->count() : 0 }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>
    </div>
    
@endsection