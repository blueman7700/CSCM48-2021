@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label']) }}>
    <b>{{ $value ?? $slot }}</b>
</label>
