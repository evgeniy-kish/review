<?php

/**
 * @var \App\Models\Attribute[] $attributes
 */

?>
@foreach($attributes as $attribute)
    <div class="form-group">
        <label class="form-label" for="attribute-{{ $attribute->id }}">{{ $attribute->name }}</label>
        <div class="form-control-wrap">
            @if($attribute->isSelect())
                <select id="attribute-{{ $attribute->id }}" class="form-control form-select" name="attributes[{{ $attribute->id }}]" {{ $attribute->required ? 'required' : '' }}>
                    <option value="" disabled selected>- Выберите Вариант -</option>
                    @foreach($attribute->variants as $variant)
                        <option value="{{ $variant }}">{{ $variant }}</option>
                    @endforeach
                </select>
            @else
                <input type="{{ $attribute->isNumber() ? 'number': 'text' }}" class="form-control" id="attribute-{{ $attribute->id }}" name="attributes[{{ $attribute->id }}]" value="" {{ $attribute->required ? 'required' : '' }}>
            @endif
        </div>
    </div>
@endforeach
