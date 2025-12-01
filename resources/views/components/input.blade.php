@props([
    'type' => 'text' ,
    'name' ,
    'placeholder' => ''  ,
    'value' => null ,
    'label' => false
    ])

@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<div class="form-group">
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name , $value ?? '') }}"
        placeholder="{{ $placeholder }}"
        id="{{ $name }}"
        {{ $attributes->class([
            'form-control' ,
            'is-invalid' => $errors->has($name)
            ])
        }}
    >

    @error($name)
        <div class="invalid-feedback text-danger">
            {{ $message }}
        </div>
    @enderror
</div>
