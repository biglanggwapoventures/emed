<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
   <div class="row">
       <div class="col-md-12">
             @if($label)
                {{ Form::label($name, $label, ['class' => 'control-label']) }}
            @endif
       </div>
   </div>
    @foreach($options AS $value => $text)
        <label class="radio-inline">
            {!! Form::radio($name, $value, $value == $selected) !!} {{ $text }}
        </label>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            @if($errors->has($name))
                <span class="help-block">{{ $errors->first($name) }}</span>
            @endif
        </div>
    </div>
</div>