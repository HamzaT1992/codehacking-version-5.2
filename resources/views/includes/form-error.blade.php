@if ($errors->has($value))
    <span class="help-block">
        <strong>{{ $errors->first($value) }}</strong>
    </span>
@endif