<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    @if($label)
        {{ Form::label($name, $label, ['class' => 'control-label']) }}
    @endif
    <select name="{{$name}}" class="form-control">
        <option></option>
        @foreach($specialization AS $s)
            @php
                $selected = $selected == $s->id ? 'selected="selected"' : ''
            @endphp
            <option value="{{ $s->id }}" data-subspecialization="{{ json_encode($s->subspecializations->pluck('name', 'id') ) }}" {{ $selected }}>{{ $s->name }}</option>
        @endforeach
    </select>
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>