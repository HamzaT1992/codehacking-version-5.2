<button class="btn btn-link btn--reply" data-toggle="collapse" data-target="#{{ $comment->id }}">Reply</button>

<div  id="{{ $comment->id }}" class="media--reply collapse">
    {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@store']) !!}
    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
        {!! Form::textarea('body', null, ['class' => 'form-control',  'rows' => 1]) !!}
        @include('includes.form-error', ['value' => 'body'])
    </div>
    <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>