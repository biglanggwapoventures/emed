<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    @if($label) {{ Form::label($name, $label, ['class' => 'control-label']) }} @endif
    <select name="{{$name}}" class="form-control">
        <option></option>
        @foreach($affiliations AS $a)
            <option value="{{ $a->id }}">{{ $a->affiliations }}</option>
        @endforeach
    </select> @if($errors->has($name))
    <span class="help-block">{{ $errors->first($name) }}</span> @endif
</div>
